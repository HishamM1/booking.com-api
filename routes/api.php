<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Owner\PropertyController;
use App\Http\Controllers\User\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('owner/properties', [PropertyController::class, 'index']);
    Route::post('owner/properties', [PropertyController::class, 'store']);
    Route::get('user/bookings', [BookingController::class, 'index']);
});
