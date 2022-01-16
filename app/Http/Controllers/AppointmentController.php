<?php

namespace App\Http\Controllers;

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
     * @return RedirectResponse
     */
    public function book(AppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $appointment = Appointment::find($validated['id']);
        $appointment->place()->associate(Place::find($validated['place']));
        $appointment->student()->associate(Student::find(Auth::id()));
        $appointment->comment = $validated['comment'];

        $appointment->save();
        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($request->validated()));
        return back()->with('status', 'appointment-created');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function unbook(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $this->authorize('update-appointment', $appointment);
        $appointment->student()->dissociate();
        $appointment->comment = null;
        $appointment->save();

        Log::channel('user_actions')->info(Auth::id() . ': cancelled ' . $request->id);
        return back()->with('status', 'appointment-deleted');
    }

    /**
     * Returns view for instructor
     *
     * @return Response|ResponseFactory
     */
    public function instructorView()
    {
        $appointments = Appointment::ofThisInstructor()
            ->ofThisWeekAndHigher()
            ->onlyBooked()
            ->with(['schedule', 'group', 'student', 'vehicle', 'place'])
            ->paginate(30);

        $appointments = (new AppointmentCollection($appointments));

        return inertia('Appointments/Instructor', [
            'appointments' => $appointments,
        ]);
    }
}
