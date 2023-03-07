<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\PromotersController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\LocationsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;


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

Route::get("/login", function () {
    return view("admin.auth.login");
})->name("admin.login");

Route::post("/login", [App\Http\Controllers\Admin\AuthController::class, 'login']);
Route::group([
    'middleware' => ['auth:admin'],
], function () {
    Route::get('/', [AdminHomeController::class, "index"]);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('admins', AdminsController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('venue', VenueController::class);
    Route::resource('artist', ArtistController::class);
    Route::resource('campaign', CampaignController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('promoters', PromotersController::class);
    Route::resource('locations', LocationsController::class);
    Route::resource('coupon', CouponController::class);

    //contacts
    Route::resource('contact', ContactController::class);
    Route::post('contact/import', [ContactController::class, "import"]);
    Route::post('contact/whatsapp-campaign', [ContactController::class, "whatsappCampaign"]);
    Route::post('contact/email-campaign', [ContactController::class, "emailCampaign"]);
    //files
    Route::controller(FileManagerController::class)->group(function () {
        Route::get('files',  "index")->name("admin.files");
        Route::post('files/folder',  "newFolder");
        Route::post('files/file',  "newFile");
        Route::post('files/ck-upload',  "ckUpload");
        Route::post('files/uploader',  "uploader");
    });

    //events
    Route::controller(EventController::class)->group(function () {
        Route::get('/event',  "index")->middleware("permission:event:list");
        Route::post('/event', "create")->middleware("permission:event:create");

        Route::get('/event/{event_id}/dashboard', 'dashboard')->middleware("permission:event:dashboard")->name("admin:event:dashboard");

        Route::get('/event/{event_id}/orders', 'orders')->middleware("permission:event:orders")->name("admin:event:orders");
        Route::post('/event/{event_id}/orders/details',  "orderDetails")->middleware("permission:event:orders");
        Route::post('/event/{event_id}/orders/resend-mail',  "resendMail")->middleware("permission:event:orders");
        Route::post('/event/{event_id}/orders/cancel',  "cancelOrder")->middleware("permission:event:orders");

        Route::get('/event/{event_id}/tickets',  'tickets')->middleware("permission:event:tickets")->name("admin:event:tickets");
        Route::post('/event/{event_id}/tickets/form',  'getTicketForm')->middleware("permission:event:tickets");
        Route::post('/event/{event_id}/tickets',  'saveTicket')->middleware("permission:event:tickets");
        
        Route::get('/event/{event_id}/customize',  'customize')->middleware("permission:event:customize")->name("admin:event:customize");
        Route::post('/event/{event_id}/customize',  'saveEvent')->middleware("permission:event:customize");
        Route::post('/event/{event_id}/customize/album-images',  'addAlbumImage')->middleware("permission:event:customize");
        Route::delete('/event/{event_id}/customize/album-images',  'deleteAlbumImage')->middleware("permission:event:customize");

        Route::get('/event/{event_id}/check-in',  'checkInView')->middleware("permission:event:check-in")->name("admin:event:check-in");
        Route::post('/event/{event_id}/check-in/details',  'checkInDetails')->middleware("permission:event:check-in");
        Route::post('/event/{event_id}/check-in',  'checkIn')->middleware("permission:event:check-in");

        Route::get('/event/{event_id}/status', "status")->middleware("permission:event:status");
        Route::get('/event/delete/{id}', "delete")->middleware("permission:event:delete");
    });

    Route::post('settings/inline-edit', [SettingsController::class, "inlineEdit"]);
    Route::get('profile', [ProfileController::class, "index"]);
    Route::post('profile', [ProfileController::class, "update"]);
    Route::post('profile/change-password', [ProfileController::class, "changePassword"]);
});