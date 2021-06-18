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

    Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews');

    Route::group(['middleware' => ['role:candidate'], 'prefix' => 'interviews'], function () {
        Route::put('/schedule', [InterviewController::class, 'schedule'])->name('interviews.schedule');
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/interviewers', [UserController::class, 'index'])->name('interviewers');
        Route::get('/interviewers/new', [UserController::class, 'create'])->name('interviewers.create');
        Route::get('/interviewers/{interviewer}', [UserController::class, 'show'])->name('interviewers.show');
    });

    Route::group(['middleware' => ['role:interviewer']], function () {
        Route::get('/interviews/new', [InterviewController::class, 'create'])->name('interviews.create');
        Route::post('/interviews/new', [InterviewController::class, 'store'])->name('interviews.store');

        Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates');
        Route::get('/candidates/new', [CandidateController::class, 'create'])->name('candidates.create');
        Route::post('/candidates/new', [CandidateController::class, 'store'])->name('candidates.store');
        Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');

        Route::get('/availability', [AvailabilityController::class, 'index'])->name('availability');
        Route::get('/set-availability', [AvailabilityController::class, 'viewCreateForm'])->name('availability.create');
        Route::post('/set-availability', [AvailabilityController::class, 'store'])->name('availability.store');
    });
});
