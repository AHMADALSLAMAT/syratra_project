<?php

use App\Http\Controllers\FlightAndHotelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front_End\TourController;
use App\Http\Controllers\Front_End\FrontController;
use App\Http\Controllers\Front_End\HotelController;
use App\Http\Controllers\Front_End\FlightController;
use App\Http\Controllers\Front_End\Auth\FrontAuthController;
use App\Http\Controllers\Front_End\BookingController;

/*
|--------------------------------------------------------------------------
| Front End Controllers
|--------------------------------------------------------------------------
|
| this section for the front end actions that will deal between the database and
| the sections below
|
*/

Route::get('/', [FrontController::class, 'homepage'])->name('homepage');

Route::get('/front-login', [FrontAuthController::class, 'front_login'])->name('front.login');
Route::post('/front-login', [FrontAuthController::class, 'front_login_post'])->name('front.login_post');
Route::get('/user-userlogout', [FrontAuthController::class, 'userlogout'])->name('userlogout');
Route::get('/hot-deals', [FrontController::class, 'hotDeals'])->name('hotDeals');

Route::post('/review-user', [FrontAuthController::class, 'review'])->name('review.user');


/*
|--------------------------------------------------------------------------
| Search Route for Travel
|--------------------------------------------------------------------------
*/


Route::post('/search/{formName}',[FrontController::class,'searchForm']);
Route::get('/searchdata',[FrontController::class,'searchFormdata'])->name('searchdata');
Route::get('/get-airport-data', [FrontController::class, 'getAirportData']);

/*
|--------------------------------------------------------------------------
| HOTEL Route for Travel
|--------------------------------------------------------------------------
*/

Route::get('/hotels-and-flight',
[FlightAndHotelController::class,'getAllFlightsAndHotels'])
->name('getAllFlightsAndHotels');

Route::get('/hotels',[HotelController::class,'view_hotel'])->name('view_hotel');
Route::get('/hotels/{slug}',[HotelController::class,'single_hotel'])->name('singlehotel');
Route::post('/hotel-filter',[HotelController::class,'hotel_filter'])->name('hotelfilter');



/*
|--------------------------------------------------------------------------
| TOURS Route for Travel
|--------------------------------------------------------------------------
*/


Route::get('/tours',[TourController::class,'view_tour'])->name('view_tour');
Route::get('/tours/{slug}',[TourController::class,'single_tour'])->name('singletour');
Route::post('/tours-filter',[TourController::class,'package_filter'])->name('packagefilter');


/*
|--------------------------------------------------------------------------
| FLIGHTS Route for Travel
|--------------------------------------------------------------------------
*/

Route::get('/flights',[FlightController::class,'view_flight'])->name('view_flight');
Route::get('/flights/{slug}',[FlightController::class,'single_flight'])->name('singleflight');
Route::post('/flights-filter',[FlightController::class,'flight_filter'])->name('flightfilter');
Route::post('/flight-searchdata',[FlightController::class,'flight_searchFormdata'])->name('flight_searchdata');
Route::get('/flights-search',[FlightController::class,'flightSearch'])->name('flightsearch');
/*
|--------------------------------------------------------------------------
| BOOKING Route for Travel
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function () {
     /*
    |--------------------------------------------------------------------------
    | BOOKING FLIGHT
    |--------------------------------------------------------------------------
    */
    Route::get('/flights-booking',[BookingController::class,'flightbooking'])
    ->name('flightbooking');
    Route::match(['get','post'],
    '/flights-booking-post',
    [BookingController::class,'flightbooking_post'])
    ->name('flightbooking_post');

    // FLIGHT payemnt Submit Data

    Route::post(
    '/payment-submit',
    [BookingController::class,'paymentSubmit'])
    ->name('payment-submit');

    Route::get('changeFlightPrice',[BookingController::class,'changeFlightPrice'])->name('changeFlightPrice');

    Route::get('thankyou/{$info}',[BookingController::class,'thankyou'])->name('thankyou');
    Route::post('selected-seats',[BookingController::class,'selectseats'])->name('selectseats');
    /*
    |--------------------------------------------------------------------------
    | BOOKING HOTEL
    |--------------------------------------------------------------------------
    */

    Route::get('/hotel-booking/{id}',[HotelController::class,'hotel_booking'])->name('hotelbooking');
    Route::post('payment-hotel',[HotelController::class,'hotelpayment'])->name('hotelpayment');
    /*
    |--------------------------------------------------------------------------
    | BOOKING Tours
    |--------------------------------------------------------------------------
    */

    Route::get('/tours-booking/{id}',[TourController::class,'tours_booking'])->name('toursbooking');
    Route::post('payment-tours',[TourController::class,'tourspayment'])->name('tourspayment');



});
