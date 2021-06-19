<?php

use App\Http\Controllers\API\InterviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'interviews'], function () {
    Route::get('/', [InterviewController::class, 'index']);
    Route::get('/{interview}', [InterviewController::class, 'show']);
    Route::get('/{interview}/available-slots', [InterviewController::class, 'availableSlots']);
});
