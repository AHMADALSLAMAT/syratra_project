<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Flight;
use App\Helpers\MyFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightAndHotelController extends Controller
{
    //get all flights and hotels in same country if found

    public function getAllFlightsAndHotels() {
        $countsByCountry = DB::table('flights')
        ->select('flights.flight_arrive_country',
                 DB::raw('GROUP_CONCAT(DISTINCT hotels.id) as hotel_ids'),
                 DB::raw('GROUP_CONCAT(DISTINCT flights.id) as flight_ids'),
                 DB::raw('COUNT(DISTINCT hotels.id) as hotel_count'),
                 DB::raw('COUNT(DISTINCT flights.id) as flight_count')
        )
        ->leftJoin('hotels', function($join) {
            $join->on('flights.flight_arrive_country', '=', DB::raw('(SELECT country FROM countries WHERE id = hotels.loca_country)'))->where('hotels.hotel_status', 1);
        })
        ->groupBy('flights.flight_arrive_country')
        ->orderByRaw('hotel_count + flight_count DESC')
        ->get();
        dd($countsByCountry);
    // Initialize an array to hold all data
    $countryData = [];

    // Loop through the results and organize data by country
    foreach ($countsByCountry as $countryInfo) {
        $country = $countryInfo->flight_arrive_country;
        $hotelIds = explode(',', $countryInfo->hotel_ids);
        $flightIds = explode(',', $countryInfo->flight_ids);

        // Remove empty strings and convert IDs to integers
        $hotelIds = array_filter(array_map('intval', $hotelIds));
        $flightIds = array_filter(array_map('intval', $flightIds));

        // Store data for this country
        $countryData[$country] = [
            'hotels' => $hotelIds,
            'flights' => $flightIds,
            'hotel_count' => $countryInfo->hotel_count,
            'flight_count' => $countryInfo->flight_count,
        ];
        }
        return view('Front_End.pages.flight_and_hotel.flight_and_hotel',compact('countryData'));
    }
}
