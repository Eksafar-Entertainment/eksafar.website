<?php

use App\Http\Controllers\Admin\EventController;
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

Route::get('/', function () {
    return view('welcome');
});

//admin events routes
Route::controller(EventController::class)->group(function () {
    Route::get('/admin/event',  "index");

    Route::get('/admin/event/form/{eventId}', "details");
    Route::get('/admin/event/form', "details");

    Route::post('/admin/event/form/{eventId}', "save");
    Route::post('/admin/event/form', "save");

});
