<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Front\EventController as FrontEventController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\RazorpayController;
use App\Http\Controllers\Front\CashfreeController;
use Illuminate\Support\Facades\Auth;

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


Route::get("/ticket", function () {
    return view("ticket.index");
});
//payment related routes
Route::group(['prefix' => "/payment"], function () {
    Route::post('/razorpay/checkout', [RazorpayController::class, 'checkout'])->name("payment:razorpay:checkout");
    Route::post('/razorpay/complete', [RazorpayController::class, 'complete'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->name("payment:razorpay:complete");
    Route::post('/razorpay/webhook', [RazorpayController::class, 'webhook'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->name("payment:razorpay:webhook");

    Route::post('/cashfree/checkout', [CashfreeController::class, 'checkout'])->name("payment:cashfree:checkout");
    Route::get('/cashfree/complete', [CashfreeController::class, 'complete'])->name("payment:cashfree:complete");
    Route::post('/cashfree/webhook', [CashfreeController::class, 'webhook'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->name("payment:cashfree:webhook");
});

//frontend routes
Auth::routes();
Route::post('/auth/check-user-email', [App\Http\Controllers\Front\AuthController::class, 'checkUserEmail']);
Route::post('/auth/check-user-discount', [App\Http\Controllers\Front\RazorpayController::class, 'checkUserDiscount']);
Route::post('/auth/try-login', [App\Http\Controllers\Front\AuthController::class, 'tryLogin']);

//image related functions
Route::get('/resources/images', [App\Http\Controllers\Front\Settings\ImageController::class, "serve"])->name("resources:images");
Route::get('/resources/images/qr', [App\Http\Controllers\Front\Settings\ImageController::class, "generateQrCode"])->name("resources:images:qr");

Route::group([
    "middleware" => ["access_log"],
    "prefix" => "/"
], function () {
    Route::get('/', [FrontController::class, 'index']);
    Route::post('/contact', [FrontController::class, 'contact']);
    Route::get("/event/{slug}", [FrontEventController::class, 'details']);
    Route::get('/{path}', [FrontController::class, 'route'])->where('path', '.*');
});
