<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\HomeController;

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

Route::post("auth/register", [AuthController::class, "register"]);
Route::post("auth/login", [AuthController::class, "login"]);

Route::get("auth/login/{provider}", [AuthController::class, "social"]);
Route::get("auth/callback/{provider}", [AuthController::class, "callback"]);

Route::post("auth/login/send-otp", [AuthController::class, "sendOtp"]);
Route::post("auth/login/verify-otp", [AuthController::class, "verifyOtp"]);

Route::get("main-page", [HomeController::class, "mainPage"]);
Route::get("app-data", [HomeController::class, "appData"]);

//events 
Route::get("events/{event_id}", [EventController::class, "details"]);
Route::get("events/{event_id}/tickets", [EventController::class, "tickets"]);

Route::get("events/checkout/pay", [EventController::class, "checkoutPay"]);
Route::group(["middleware" => ["auth:api"]], function () {
    Route::get("me/profile", [AuthController::class, "profile"]);
    Route::get("auth/logout", [AuthController::class, "logout"]);


    Route::post("events/checkout/session", [EventController::class, "checkoutSession"]);
    
});
