<?php

use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewerController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'home')->name('home');

Route::group(['prefix' => '{type}', 'middleware' => ['type']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews');
});

Route::group(['prefix' => 'interviewer'], function () {
	Route::get('/interviews/new', [InterviewController::class, 'create'])->name('interviews.create');
	Route::post('/interviews/new', [InterviewController::class, 'store'])->name('interviews.store');

    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates');
    Route::get('/candidates/new', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/candidates/new', [CandidateController::class, 'store'])->name('candidates.store');
    Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');

    Route::get('/interviewers', [InterviewerController::class, 'index'])->name('interviewers');
    Route::get('/interviewers/{interviewer}', [InterviewerController::class, 'show'])->name('interviewers.show');

    Route::get('/availability', [AvailabilityController::class, 'index'])->name('availability');
    Route::get('/set-availability', [AvailabilityController::class, 'viewCreateForm'])->name('availability.create');
    Route::post('/set-availability', [AvailabilityController::class, 'store'])->name('availability.store');
});

Route::group(['prefix' => 'candidate'], function () {
    Route::group(['prefix' => 'interviews'], function () {
        Route::put('/schedule', [InterviewController::class, 'schedule'])->name('interviews.schedule');
    });
});
