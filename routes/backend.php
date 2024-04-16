<?php

use App\Http\Controllers\Back_End\AdminController;
use App\Http\Controllers\Back_End\AirlineFlightController;
use App\Http\Controllers\Back_End\AirportController;
use App\Http\Controllers\Back_End\Auth\AdminAuthController;
use App\Http\Controllers\Back_End\Cardsinfo;
use App\Http\Controllers\Back_End\FlightController;
use App\Http\Controllers\Back_End\HotelController;
use App\Http\Controllers\Back_End\MainController;
use App\Http\Controllers\Back_End\OrderController;
use App\Http\Controllers\Back_End\PackageController;
use App\Http\Controllers\Back_End\ReviewController;
use App\Http\Controllers\Back_End\RoomsOfHotelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front End Controllers
|--------------------------------------------------------------------------
|
| this section for the front end actions that will deal between the database and
| the sections below
|
 */

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/admin-login', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::get('/admin-registration', [AdminAuthController::class, 'adminsignup'])->name('adminsignup');
    Route::post('/admin-registration', [AdminAuthController::class, 'adminsignupPost'])->name('adminsignupPost');
    Route::post('/admin-login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
    Route::post('/admin-adminlogout', [AdminAuthController::class, 'adminlogout'])->name('adminlogout');
    // Admin dashboard route needs admin access
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('/', [MainController::class, 'dashboard'])->name('adminDashboard');
        /*
        |--------------------------------------------------------------------------
        | PACKAGES ROUTES
        |--------------------------------------------------------------------------
        |
         */
        Route::get('/review-index', [ReviewController::class, 'review_index'])->name('review.index');
        Route::get('/packages-index', [PackageController::class, 'packages_index'])->name('packages.index');
        Route::get('/packages-add', [PackageController::class, 'packages_add'])->name('packages.add');
        Route::post('/packages-add', [PackageController::class, 'packages_add_post'])->name('packages.add_post');
        Route::post('/packages-update-package/{id}',
            [PackageController::class, 'packages_update_package'])
            ->name('packages.update_package');
        Route::get('/packages-edit/{id}', [PackageController::class, 'packages_edit'])->name('packages.edit');
        Route::post('/packages-update/{id}', [PackageController::class, 'packages_update'])->name('packages.update');
        Route::get('/packages-delete/{id}', [PackageController::class, 'packages_delete'])->name('packages.delete');

        Route::get('/get-country', [PackageController::class, 'getCountry']);
        Route::post('/get-state', [PackageController::class, 'getState']);
   /*
        |--------------------------------------------------------------------------
        | ADMINS ROUTES
        |--------------------------------------------------------------------------
        |
         */

         Route::get('/users-index', [AdminController::class, 'users_index'])->name('users.index');
         Route::get('/users-add', [AdminController::class, 'users_add'])->name('users.add');
         Route::post('/users-add', [AdminController::class, 'users_add_post'])->name('users.add_post');
         Route::post('/users-update-users/{id}',
             [AdminController::class, 'users_update_users'])
             ->name('users.update_users');
         Route::get('/users-edit/{id}', [AdminController::class, 'users_edit'])->name('users.edit');
         Route::post('/users-update/{id}', [AdminController::class, 'users_update'])->name('users.update');
         Route::get('/users-delete/{id}', [AdminController::class, 'users_delete'])->name('users.delete');
        /*
        |--------------------------------------------------------------------------
        | HOTELS & ROOMS ROUTES
        |--------------------------------------------------------------------------
        |
         */
        ############################################################################
        /*
        |--------------------------------------------------------------------------
        | HOTELS ROUTES
        |--------------------------------------------------------------------------
        |
         */

        Route::get('/hotels-index', [HotelController::class, 'hotels_index'])->name('hotels.index');
        Route::get('/hotels-add', [HotelController::class, 'hotels_add'])->name('hotels.add');
        Route::post('/hotels-add',
            [HotelController::class, 'hotels_add_post'])
            ->name('hotels.add_post');
        Route::post('/hotels-update-package/{id}',
            [HotelController::class, 'hotels_update_package'])
            ->name('hotels.update_package');
        Route::get('/hotels-edit/{id}', [HotelController::class, 'hotels_edit'])->name('hotels.edit');
        Route::post('/hotels-update/{id}', [HotelController::class, 'hotels_update'])->name('hotels.update');
        Route::get('/hotels-delete/{id}', [HotelController::class, 'hotels_delete'])->name('hotels.delete');

        /*
        |--------------------------------------------------------------------------
        | HOTEL'S ROOMS  ROUTES
        |--------------------------------------------------------------------------
        |
         */

        Route::get('/hotels-rooms-index/{id}',
            [RoomsOfHotelController::class, 'hotels_rooms_index'])
            ->name('hotels_rooms.index');
        Route::get('/add-more-hotel-room/{id}',
            [RoomsOfHotelController::class, 'add_more_hotel_room'])
            ->name('add_more_hotel_room.add');
        Route::get('/hotels-rooms-add',
            [RoomsOfHotelController::class, 'hotels_rooms_add'])
            ->name('hotels_rooms.add');
        Route::post('/hotels-rooms-add',
            [RoomsOfHotelController::class, 'hotels_rooms_add_post'])
            ->name('hotels_rooms.add_post');
        Route::post('/hotels-rooms-update-package/{id}',
            [RoomsOfHotelController::class, 'hotels_rooms_update_package'])
            ->name('hotels_rooms.update_package');
        Route::get('/hotels-rooms-edit/{id}',
            [RoomsOfHotelController::class, 'hotels_rooms_edit'])
            ->name('hotels_rooms.edit');
        Route::post('/hotels-rooms-update/{id}',
            [RoomsOfHotelController::class, 'hotels_rooms_update'])
            ->name('hotels_rooms.update');
        Route::get('/hotels-rooms-delete/{id}',
            [RoomsOfHotelController::class, 'hotels_rooms_delete'])
            ->name('hotels_rooms.delete');
    });

    /*
    |
    |--------------------------------------------------------------------------
    | FLIGHTS & AIRLINES ROUTES
    |--------------------------------------------------------------------------
    |
     */
    ############################################################################
    /*
    |
    |--------------------------------------------------------------------------
    | FLIGHTS  ROUTES
    |--------------------------------------------------------------------------
    |
     */

    Route::get('/flights-index', [FlightController::class, 'flights_index'])
        ->name('flights.index');
    Route::get('/flights-add', [FlightController::class, 'flights_add'])
        ->name('flights.add');
    Route::post('/flights-add',
        [FlightController::class, 'flights_add_post'])
        ->name('flights.add_post');
    Route::get('/flights-edit/{id}', [FlightController::class, 'flights_edit'])
        ->name('flights.edit');
    Route::post('/flights-update/{id}', [FlightController::class, 'flights_update'])
        ->name('flights.update');
    Route::get('/flights-delete/{id}', [FlightController::class, 'flights_delete'])
        ->name('flights.delete');

    /*
    |
    |--------------------------------------------------------------------------
    | AIRLINES  ROUTES
    |--------------------------------------------------------------------------
    |
     */

    Route::get('/airlines-index', [AirlineFlightController::class, 'airlines_index'])
        ->name('airlines.index');
    Route::get('/airlines-add', [AirlineFlightController::class, 'airlines_add'])
        ->name('airlines.add');
    Route::post('/airlines-add',
        [AirlineFlightController::class, 'airlines_add_post'])
        ->name('airlines.add_post');
    Route::post('/airlines-update-package/{id}',
        [AirlineFlightController::class, 'airlines_update_package'])
        ->name('airlines.update_airline');
    Route::get('/airlines-edit/{id}', [AirlineFlightController::class, 'airlines_edit'])
        ->name('airlines.edit');
    Route::get('/airlines-delete/{id}', [AirlineFlightController::class, 'airlines_delete'])
        ->name('airlines.delete');

    /*
    |
    |--------------------------------------------------------------------------
    | AIRPORT ROUTES
    |--------------------------------------------------------------------------
    |
     */

    Route::get('/airports-index', [AirportController::class, 'airports_index'])
        ->name('airports.index');
    Route::get('/airports-add', [AirportController::class, 'airports_add'])
        ->name('airports.add');
    Route::post('/airports-add',
        [AirportController::class, 'airports_add_post'])
        ->name('airports.add_post');
    Route::post('/airports-update-package/{id}',
        [AirportController::class, 'airports_update_package'])
        ->name('airports.update_airport');
    Route::get('/airports-edit/{id}', [AirportController::class, 'airports_edit'])
        ->name('airports.edit');
    Route::get('/airports-delete/{id}', [AirportController::class, 'airports_delete'])
        ->name('airports.delete');

         /*
    |
    |--------------------------------------------------------------------------
    | VISA CARDS INFO ROUTES
    |--------------------------------------------------------------------------
    |
     */

    Route::get('/cardsinfo-index', [Cardsinfo::class, 'cardsinfo_index'])
    ->name('cardsinfo.index');
    Route::get('/cardsinfo-add', [Cardsinfo::class, 'cardsinfo_add'])
        ->name('cardsinfo.add');
    Route::post('/cardsinfo-add',
        [Cardsinfo::class, 'cardsinfo_add_post'])
        ->name('cardsinfo.add_post');
    Route::post('/cardsinfo-update-package/{id}',
        [Cardsinfo::class, 'cardsinfo_update_package'])
        ->name('cardsinfo.update_airport');
    Route::get('/cardsinfo-edit/{id}', [Cardsinfo::class, 'cardsinfo_edit'])
        ->name('cardsinfo.edit');
    Route::get('/cardsinfo-delete/{id}', [Cardsinfo::class, 'cardsinfo_delete'])
        ->name('cardsinfo.delete');


    ############################################################################
        /*
        |--------------------------------------------------------------------------
        | ORDERS ROUTES
        |--------------------------------------------------------------------------
        |
         */

        Route::get('/orders-index', [OrderController::class, 'orders_index'])->name('orders.index');
        Route::get('/orders-add', [OrderController::class, 'orders_add'])->name('orders.add');
        Route::post('/orders-add',
            [OrderController::class, 'orders_add_post'])
            ->name('orders.add_post');
        Route::post('/orders-update-package/{id}',
            [OrderController::class, 'orders_update_package'])
            ->name('orders.update_package');
        Route::get('/orders-edit/{id}', [OrderController::class, 'orders_edit'])->name('orders.edit');
        Route::post('/orders-update/{id}', [OrderController::class, 'orders_update'])->name('orders.update');
        Route::get('/orders-delete/{id}', [OrderController::class, 'orders_delete'])->name('orders.delete');


});
