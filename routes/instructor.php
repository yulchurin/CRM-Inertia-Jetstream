<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:instructor'])->group(function () {

    Route::get('/appointments/instructor', [AppointmentController::class, 'instructorView'])
        ->name('appointments.instructor');

});
