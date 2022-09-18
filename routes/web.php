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
use App\Http\Controllers\Admin\PermissionsController;

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
    Route::resource('permissions', PermissionsController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('promoters', PromotersController::class);
    //files
    Route::get('files', [FileManagerController::class, "index"])->name("admin.files");
    Route::post('files/folder', [FileManagerController::class, "newFolder"]);
    Route::post('files/file', [FileManagerController::class, "newFile"]);
    Route::post('files/ck-upload', [FileManagerController::class, "ckUpload"]);

    //orders
    //Route::resource('order', OrderController::class);


    //events
    Route::controller(EventController::class)->group(function () {
        Route::get('/event',  "index")->middleware("permission:event:list");
        Route::get('/event/{event_id}/dashboard', [EventController::class, 'dashboard'])->middleware("permission:event:dashboard");

        Route::get('/event/{event_id}/orders', [EventController::class, 'orders'])->middleware("permission:event:orders");
        Route::post('/event/{event_id}/orders/details', [EventController::class, "orderDetails"])->middleware("permission:event:orders");

        Route::get('/event/{event_id}/tickets', [EventController::class, 'tickets'])->middleware("permission:event:tickets");

        Route::post('/event/{event_id}/tickets/form', [EventController::class, 'getTicketForm'])->middleware("permission:event:tickets");
        Route::post('/event/{event_id}/tickets', [EventController::class, 'saveTicket'])->middleware("permission:event:tickets");

        Route::get('/event/{event_id}/customize', [EventController::class, 'customize'])->middleware("permission:event:customize");
        Route::post('/event/{event_id}/customize', [EventController::class, 'saveEvent'])->middleware("permission:event:customize");

        Route::get('/event/{event_id}/check-in', [EventController::class, 'checkInView'])->middleware("permission:event:check-in");
        Route::post('/event/{event_id}/check-in/details', [EventController::class, 'checkInDetails'])->middleware("permission:event:check-in");
        Route::post('/event/{event_id}/check-in', [EventController::class, 'checkIn'])->middleware("permission:event:check-in");

        Route::get('/event/delete/{id}', "delete")->middleware("permission:event:delete");

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
