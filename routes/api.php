<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
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

Route::post("auth/register", [UserController::class, "register"]);
Route::post("auth/login", [UserController::class, "login"]);
Route::group(["middleware" => ["auth:api"]], function () {
    Route::get("me/profile", [UserController::class, "profile"]);
    Route::get("auth/logout", [UserController::class, "logout"]);

    Route::get("main-page", [HomeController::class, "mainPage"]);
});
