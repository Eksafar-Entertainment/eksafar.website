<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Promoter\EventController;
use App\Http\Controllers\Promoter\HomeController;
use App\Http\Controllers\Promoter\AuthController;



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

Route::get("/login", function () {
    return view("promoter.auth.login");
})->name("promoter.login");

Route::post("/login", [AuthController::class, 'login']);
Route::group([
    'middleware' => ['auth:promoter'],
], function () {
    Route::get('/', [HomeController::class, "index"]);
    //events
    Route::controller(EventController::class)->group(function () {
        Route::get('/event',  "index");
        Route::get('/event/{event_id}/dashboard', 'dashboard')->name("promoter:event:dashboard");
    });
});