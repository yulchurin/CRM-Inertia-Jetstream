<?php

declare(strict_types=1);

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaperController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/socialite.php';
require __DIR__ . '/closures.php';
require __DIR__ . '/admin.php';

Route::middleware(['auth:sanctum', 'user.inactive'])->group(function () {
    Route::middleware('phoneFix')->group(function () {
        Route::apiResource('/person', PersonController::class)->only(['store', 'index']);

        Route::post('/parent', [PersonController::class, 'storeParent'])
            ->name('parent.store');
        Route::post('/parent/paper', [PaperController::class, 'storeParent'])
            ->name('parent.paper.store');

        Route::apiResource('/papers', PaperController::class)->only(['store']);
    });

    Route::apiResource('/appointments', AppointmentController::class);
});
