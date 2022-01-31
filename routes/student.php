<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'user.inactive', 'role:client'])->group(function () {
    Route::apiResource('/person', PersonController::class)->only(['store', 'index']);
    Route::apiResource('/papers', PaperController::class)->only(['store']);

    Route::post('/parent', [PersonController::class, 'storeParent'])
        ->name('parent.store');
    Route::post('/parent/paper', [PaperController::class, 'storeParent'])
        ->name('parent.paper.store');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::middleware('appointment.limit')->put('/appointment', [AppointmentController::class, 'book']);
    Route::delete('/appointment', [AppointmentController::class, 'unbook']);
});
