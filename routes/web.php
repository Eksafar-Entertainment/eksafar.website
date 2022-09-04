<?php

use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;

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

Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);


Route::get('/product', [RazorpayController::class, 'index']);
Route::post('/paysuccess', [RazorpayController::class, 'razorPaySuccess']);
Route::get('/payment-thank-you{id}', [RazorpayController::class, 'paymentSuccess']);

//admin events routes
Route::middleware('auth:sanctum')->get("/admin",function(){
    return view("admin.home");
});
Route::middleware('auth:sanctum')->controller(EventController::class)->group(function () {
    Route::get('/admin/event',  "index");

    Route::get('/admin/event/delete/{id}', "delete");

    Route::get('/admin/event/form/{eventId}', "details");
    Route::get('/admin/event/form', "details");

    Route::post('/admin/event/form/{eventId}', "save");
    Route::post('/admin/event/form', "save");

});

Route::middleware('auth:sanctum')->controller(OrderController::class)->group(function () {
    Route::get('/admin/order',  "index");
    Route::get('/admin/order/{eventId}', "details");
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{id}', [App\Http\Controllers\FrontController::class, 'route']);
