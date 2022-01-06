<?php

declare(strict_types=1);

/**
 * Only admin routes !
 */

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DrivingController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->group(function () {

        Route::middleware(['auth:sanctum', 'management'])->group(function () {
            Route::resource('/users', UserController::class);
            Route::apiResource('/company', CompanyController::class)->only(['store', 'index']);

            Route::apiResource('/driving', DrivingController::class);

            Route::apiResource('/schedules', ScheduleController::class);

            // courses
            // lessons
        });

    Route::get('/test', [UserController::class, 'index']);//todo
});
