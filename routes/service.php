<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/inactive', function () {
    return Inertia::render('Welcome', [
        'auth' => Auth::check(),
        'user' => Auth::user()->name,
    ]);
})->middleware(['user.inactive']);
