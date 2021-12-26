<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'user.active'])->get('/person', function () {
    return Inertia::render('Profile/Person', [
        'person' => auth()->user()->person,
        'passport' => auth()->user()->paper,
        'parent' => auth()->user()->legalRepresentativePerson,
        'parent_pass' => auth()->user()->legalRepresentativePerson->paper,
    ]);

})->name('person');


Route::get('/test', function () {
    $group = \App\Models\Group::find(1);
    return \App\Services\SumToWords::spell(20005);
});
