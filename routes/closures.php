<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified', 'user.inactive'])->get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::middleware('user.active')->get('/inactive', function () {
    return Inertia::render('UserInactive', [
        'auth' => Auth::check(),
        'user' => Auth::user()?->name,
        'google' => (bool) Auth::user()?->google_id,
        'vk' => (bool) Auth::user()?->vk_id,
    ]);
});
