<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

require __DIR__ . '/socialite.php';
require __DIR__ . '/service.php';

Route::middleware(['auth:sanctum', 'verified', 'user.active'])->get('/', function () {

    Inertia::share('auth', function () {
        return Auth::user();
    });

    Inertia::share('admin', function () {
        return Auth::user()->isAdmin() || Auth::user()->isAssistant();
    });

    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/appointments', function () {
    echo 'aaaa';
})->name('appointments');

Route::middleware(['auth:sanctum'])->group(function () {
    //Route::middleware(['management'])->group(function () {
        //Route::resource('/users', UserController::class);
    //});
});

Route::resource('/users', UserController::class);
