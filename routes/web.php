<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Models\Topic;

Route::get('/', function () {
    $topics = Topic::withCount('registrations')->orderBy('event_date')->get();
    return view('welcome', compact('topics'));
})->name('welcome');

Route::get('/topics/{topic}', [TopicController::class , 'show'])->name('topics.show');
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/topics/{topic}/attendees', [TopicController::class , 'attendees'])->name('topics.attendees');
    Route::resource('topics', TopicController::class)->except(['show']);
});

Route::get('/login', [AuthController::class , 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class , 'login'])->middleware('guest');
Route::get('/register', [AuthController::class , 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class , 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/my-workshops', [RegistrationController::class , 'index'])->name('registrations.index');
    Route::get('/topics/{topic}/register', [RegistrationController::class , 'create'])->name('registrations.create');
    Route::post('/topics/{topic}/register', [RegistrationController::class , 'store'])->name('registrations.store');

    // Admin only registration removal
    Route::delete('/registrations/{registration}', [RegistrationController::class , 'destroy'])
        ->name('registrations.destroy')
        ->middleware(\App\Http\Middleware\IsAdmin::class);
});
