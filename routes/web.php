<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\RazorpayController;

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

Route::get('/', [FrontController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group([
    'middleware' => ['auth'],
    'prefix' => "/admin"
], function () {
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('order', OrderController::class);


    Route::controller(EventController::class)->group(function () {
        Route::get('/event',  "index");

        Route::get('/event/delete/{id}', "delete");

        Route::get('/event/form/{eventId}', "details");
        Route::get('/event/form', "details");

        Route::post('/event/form/{eventId}', "save");
        Route::post('/event/form', "save");
    });
});



Route::get('/product', [RazorpayController::class, 'index']);

Route::post('/payment/checkout', [RazorpayController::class, 'checkout']);
Route::post('/payment/checkout/complete', [RazorpayController::class, 'checkoutComplete'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/payment-thank-you{id}', [RazorpayController::class, 'paymentSuccess']);


//admin events routes
Route::middleware('auth:sanctum')->get("/admin", function () {
    return view("admin.home");
});





Route::get('/{id}', [FrontController::class, 'route']);
