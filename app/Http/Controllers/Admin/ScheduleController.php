<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleCollection;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Carbon\CarbonInterval;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        $schedules = Schedule::paginate(20);

        $schedules = (new ScheduleCollection($schedules));

        return inertia('Schedule/Index', [
            'schedules' => $schedules,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ScheduleRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(ScheduleRequest $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validated();
        $duration = CarbonInterval::createFromFormat('H:i', $validated['duration'])->totalSeconds;

        if ($request->id) {
            Schedule::where('id', $request->id)->update([
                'start' => $validated['start'],
                'duration' => $duration,
            ]);
        } else {
            Schedule::create([
                'start' => $validated['start'],
                'duration' => $duration,
            ]);
        }

        return redirect()->back()->with('status', 'schedule-stored');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy($id): RedirectResponse
    {
        $schedule = Schedule::find($id);

        $this->authorize('delete', $schedule);

        $schedule->delete();

        return back()->with('message', 'Schedule was deleted');
    }

    /**
     * @param $id
     * @return Response|ResponseFactory
     */
    public function show($id): Response|ResponseFactory
    {
        $schedule = Schedule::find($id);

        $scheduleResource = $schedule ? new ScheduleResource($schedule) : null;

        return inertia('Schedule/Show', [
            'schedule' => $scheduleResource,
        ]);
    }

    /**
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Schedule/Show');
    }
}
