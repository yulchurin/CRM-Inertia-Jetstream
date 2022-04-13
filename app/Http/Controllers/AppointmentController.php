<?php

namespace App\Http\Controllers;

use App\Actions\Appointments\BookDrivingLesson;
use App\Actions\Appointments\CancelBookedDrivingLesson;
use App\Actions\DTO\DrivingLessonBookingData;
use App\Actions\Interfaces\MainAction;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentCollection;
use App\Http\Resources\PlaceCollection;
use App\Models\Appointment;
use App\Models\Place;
use App\Models\Student;
use App\Services\AppointmentLimitations;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response;
use Inertia\ResponseFactory;

class AppointmentController extends Controller
{
    /**
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        $availableSlots = Appointment::with(['schedule', 'group', 'instructor', 'vehicle', 'place'])
            ->available()
            ->paginate(20);

        $available = (new AppointmentCollection($availableSlots));

        return inertia('Appointments/Index', [
            'appointments' => $available,
            'places' => new PlaceCollection(Place::all()),
            'limited' => AppointmentLimitations::all(),
        ]);
    }

    /**
     * @param AppointmentRequest $request
     * @param MainAction $bookDrivingLesson
     * @return RedirectResponse
     */
    public function book(AppointmentRequest $request, MainAction $bookDrivingLesson): RedirectResponse
    {
        $validated = new DrivingLessonBookingData($request->validated());

        $bookDrivingLesson($validated);

        return back()->with('status', 'appointment-created');
    }

    /**
     * @param Request $request
     * @param CancelBookedDrivingLesson $cancelBookedDrivingLesson
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function unbook(Request $request, CancelBookedDrivingLesson $cancelBookedDrivingLesson): RedirectResponse
    {
        $appointment = Appointment::find($request->id);

        $this->authorize('update-appointment', $appointment);

        $cancelBookedDrivingLesson($appointment);

        return back()->with('status', 'appointment-deleted');
    }

    /**
     * Returns view for instructor
     *
     * @return Response|ResponseFactory
     */
    public function instructorView(): Response|ResponseFactory
    {
        $appointments = Appointment::query()
            ->ofThisInstructor()
            ->ofThisWeekAndHigher()
            ->onlyBooked()
            ->with(['schedule', 'group', 'student', 'vehicle', 'place'])
            ->paginate(20);

        $appointments = (new AppointmentCollection($appointments));

        return inertia('Appointments/Instructor', [
            'appointments' => $appointments,
        ]);
    }
}
