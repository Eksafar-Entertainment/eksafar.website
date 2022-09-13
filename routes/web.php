<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\PromotersController;
use App\Http\Controllers\Front\EventController as FrontEventController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\RazorpayController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

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
    Route::get('/', [AdminHomeController::class, "index"]);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('promoters', PromotersController::class);
    //files
    Route::get('files', [FileManagerController::class, "index"])->name("admin.files");
    Route::post('files/folder', [FileManagerController::class, "newFolder"]);
    Route::post('files/file', [FileManagerController::class, "newFile"]);

    //orders
    Route::resource('order', OrderController::class);
    Route::post('/order/check-in-details', [OrderController::class, "checkInDetails"]);
    Route::post('/order/check-in', [OrderController::class, "checkIn"]);

    //events
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

Route::get("/event-{slug}", [FrontEventController::class, 'details']);
// Route::get("/event/{slug}", [FrontEventController::class, 'details'])->name("event-details");
// Route::get('/event-{slug}', function($slug) {
//     return Redirect::to("/event/$slug");
// });
Route::get('/{id}', [FrontController::class, 'route']);
