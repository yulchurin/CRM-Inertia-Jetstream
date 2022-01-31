<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DrivingLessonsRequest;
use App\Http\Resources\AppointmentCollection;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\ResponseFactory;

class DrivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|ResponseFactory
     */
    public function index(): \Inertia\Response|ResponseFactory
    {
        $lessons = Appointment::paginate(20);

        $lessons = (new AppointmentCollection($lessons));

        return inertia('DrivingLessons/Index', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DrivingLessonsRequest $request
     * @return Response
     */
    public function store(DrivingLessonsRequest $request)
    {

        Appointment::create();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
