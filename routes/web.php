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


Auth::routes();
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
    //Route::resource('order', OrderController::class);


    //events
    Route::controller(EventController::class)->group(function () {
        Route::get('/event',  "index");
        Route::get('/event/{event_id}/dashboard', [EventController::class, 'dashboard']);

        Route::get('/event/{event_id}/orders', [EventController::class, 'orders']);
        Route::post('/event/orders/check-in-details', [EventController::class, "checkInDetails"]);
        Route::post('/event/orders/check-in', [EventController::class, "checkIn"]);

        Route::get('/event/{event_id}/tickets', [EventController::class, 'tickets']);

        Route::post('/event/{event_id}/tickets/form', [EventController::class, 'getTicketForm']);
        Route::post('/event/{event_id}/tickets', [EventController::class, 'saveTicket']);
        Route::get('/event/{event_id}/customize', [EventController::class, 'customize']);
        Route::post('/event/{event_id}/customize', [EventController::class, 'saveEvent']);

        Route::get('/event/delete/{id}', "delete");

        Route::get('/event/form/{eventId}', "details");
        Route::get('/event/form', "details");

        Route::post('/event/form/{eventId}', "save");
        Route::post('/event/form', "save");
    });
});

Route::post('/payment/checkout', [RazorpayController::class, 'checkout']);
Route::post('/payment/checkout/complete', [RazorpayController::class, 'checkoutComplete'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::group([
    "middleware" => ["access_log"],
    "prefix" => "/"
], function () {
    Route::get('/', [FrontController::class, 'index']);
    Route::get("/event-{slug}", [FrontEventController::class, 'details']);
    Route::get("/event/{slug}", [FrontEventController::class, 'details']);
    // Route::get('/event-{slug}', function($slug) {
    //     return Redirect::to("/event/$slug");
    // });
    Route::get('/{id}', [FrontController::class, 'route']);
});
