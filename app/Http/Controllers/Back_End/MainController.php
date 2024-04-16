<?php

namespace App\Http\Controllers\Back_End;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        //cards static info
        $count_orders = Order::get();
        $count_flights = Flight::get();
        $count_packages = Package::get();
        $count_hotels = Hotel::get();
        $reviews = Review::get();
        $latest_order_ten = Order::orderBy('id','DESC')->take('10')->get();
        // Calculate total orders revenue
        $total_orders_revenue = Order::sum('amount');
        // Calculate total flights revenue (you need to replace Flight with your flight model)
        $total_flights_revenue = Order::where('flight_id','!=', null)->sum('amount');
        // Calculate total hotels revenue (you need to replace Hotel with your hotel model)
        $total_hotels_revenue = Order::where('hotel_id','!=', null)->sum('amount');
        // Calculate total packages revenue (you need to replace Package with your package model)
        $total_packages_revenue = Order::where('package_id','!=', null)->sum('amount');

        return view('Back_End.pages.dashboard.dashboard',compact(
                'count_orders',
            'count_flights',
            'count_packages',
            'count_hotels',
            'latest_order_ten',
            'total_orders_revenue',
            'total_hotels_revenue',
            'total_flights_revenue',
            'total_packages_revenue',
            'reviews'
        ));
    }
}
