<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/events',[EventController::class, 'index']);
Route::get('/events/{id}',[EventController::class, 'show']);
Route::post('/events',[EventController::class, 'store']);
Route::put('/events/{id}',[EventController::class, 'update']);
Route::delete('/events/{id}',[EventController::class, 'destroy']);
Route::get('/upcomingEvents',[EventController::class, 'upcomingEvent']);
Route::get('/finishedEvents',[EventController::class, 'finishedEvent']);
Route::get('/lastSeventDaysEvents',[EventController::class, 'lastFinishedEvent']);
Route::get('/upcomingWeekEvent',[EventController::class, 'upcomingWeekEvent']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
