<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Recommendflight;
use App\Models\Recommendhotel;
use App\Models\Recommendpackage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Recommend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:recommend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch recommend packages every day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all the data from orders to set recommend flights , packages ,hotels

        $orders = Order::get();
        // Group orders by flight_id, hotel_id, or package_id and count the occurrences
        $flightCounts = Order::whereNotNull('flight_id')
            ->groupBy('flight_id')->
            select('flight_id', DB::raw('count(*) as total'))
            ->get();
        $hotelCounts = Order::whereNotNull('hotel_id')
            ->groupBy('hotel_id')
            ->select('hotel_id', DB::raw('count(*) as total'))
            ->get();
        $packageCounts = Order::whereNotNull('package_id')
            ->groupBy('package_id')
            ->select('package_id', DB::raw('count(*) as total'))
            ->get();

            // Update attend count for flights
            foreach ($flightCounts as $flightCount) {
                $recommendFlight = Recommendflight::firstOrNew(['flight_id' => $flightCount->flight_id]);
                $recommendFlight->attend += $flightCount->total;
                $recommendFlight->save();
            }

            // Update attend count for hotels
            foreach ($hotelCounts as $hotelCount) {
                $recommendHotel = Recommendhotel::firstOrNew(['hotel_id' => $hotelCount->hotel_id]);
                $recommendHotel->attend += $hotelCount->total;
                $recommendHotel->save();
            }

            // Update attend count for packages
            foreach ($packageCounts as $packageCount) {
                $recommendPackage = Recommendpackage::firstOrNew(['package_id' => $packageCount->package_id]);
                $recommendPackage->attend += $packageCount->total;
                $recommendPackage->save();
            }
    }
}
