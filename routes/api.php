<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
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

Route::get("main-page", [HomeController::class, "mainPage"]);

Route::group(["middleware" => ["auth:api"]], function () {
    Route::get("me/profile", [AuthController::class, "profile"]);
    Route::get("auth/logout", [AuthController::class, "logout"]);
});
