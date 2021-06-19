<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home page
Route::view('/', 'home')->name('home');

// Auth routes
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['role:candidate', 'availability'], 'prefix' => 'interviews'], function () {
        Route::get('/{interview}/schedule', [InterviewController::class, 'showScheduleForm'])->name('interviews.schedule');
        Route::post('/{interview}/schedule', [InterviewController::class, 'schedule'])->name('interviews.schedule');
    });

    Route::group(['middleware' => ['role:candidate,interviewer'], 'prefix' => 'interviews'], function () {
        Route::get('/set-availability', [AvailabilityController::class, 'viewCreateForm'])->name('availability.create');
        Route::post('/set-availability', [AvailabilityController::class, 'store'])->name('availability.store');
    });

    Route::group(['middleware' => ['role:admin,interviewer']], function () {
        Route::post('/user', [UserController::class, 'store'])->name('users.store');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/interviewers', [UserController::class, 'index'])->name('interviewers');
        Route::get('/interviewers/new', [UserController::class, 'create'])->name('interviewers.create');
        Route::get('/interviewers/{interviewer}', [UserController::class, 'show'])->name('interviewers.show');
    });

    Route::group(['middleware' => ['role:interviewer']], function () {
        Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews');
        Route::get('/interviews/new', [InterviewController::class, 'create'])->name('interviews.create');
        Route::post('/interviews/new', [InterviewController::class, 'store'])->name('interviews.store');
        Route::get('/interviews/{interview}', [InterviewController::class, 'show'])->name('interviews.show');
        Route::post('/interviews/{interview}', [InterviewController::class, 'update'])->name('interviews.update');

        Route::get('/candidates', [UserController::class, 'index'])->name('candidates');
        Route::get('/candidates/new', [UserController::class, 'create'])->name('candidates.create');
        Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');

        Route::get('/availability', [AvailabilityController::class, 'index'])->name('availability');
    });
});
