<?php

declare(strict_types=1);

/**
 * Only admin routes !
 */

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DrivingController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['middleware' => 'management'], function () {
        Route::resource('/users', UserController::class);
        Route::resource('/driving', DrivingController::class);
        Route::resource('/schedules', ScheduleController::class)->except(['update', 'edit']);
        Route::resource('/groups', GroupController::class)->except(['update', 'edit']);
        // courses
        // lessons
    });
});


Route::middleware(['auth:sanctum', 'role:owner'])
    ->apiResource('/company', CompanyController::class)
    ->only(['store', 'index']);
