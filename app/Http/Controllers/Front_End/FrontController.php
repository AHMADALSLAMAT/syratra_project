<?php

namespace App\Http\Controllers\Front_End;

use App\Models\Hotel;
use App\Models\Flight;
use App\Helpers\Search;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Hotelroom as ModelsHotelroom;
use Database\Seeders\HotelRoom;

class FrontController extends Controller
{
    // ajax get the data for airports
    public function getAirportData()
    {
        $groupOfAllFlightsCountriesAndAirports = Flight::select(
            'flight_arrive_airport',
            'flight_leave_country',
            'flight_leave_airport',
            'flight_arrive_country'
        )->distinct()->get();

        // Extract unique airport codes from both leave and arrive airports
        $airportData = $groupOfAllFlightsCountriesAndAirports->flatMap(function ($location) {
            $flight_leave_airport = Airport::where("code", $location->flight_leave_airport)->value("name");
            $flight_leave_country = Airport::where("code", $location->flight_leave_airport)->value("countryName");
            $flight_arrive_airport = Airport::where("code", $location->flight_arrive_airport)->value("name");
            $flight_arrive_country = Airport::where("code", $location->flight_arrive_airport)->value("countryName");

            // Corrected syntax for building the array
            return [
                "$flight_leave_airport ($flight_leave_country)",
                "$flight_arrive_airport ($flight_arrive_country)",
            ];
        })->unique()->values()->toArray();

        return response()->json($airportData);
    }
    //home page
    public function homepage()
    {
        $hotels = Hotel::with('Rooms')->orderBy('id','DESC')->where('hotel_status',1)->paginate(8);
        $packages = Package::orderBy('discound','DESC')->where('status',1)->paginate(8);
        $packages_group = Package::GroupPackage('loca_country',1);
        $flight_type = Flight::select('flight_type', DB::raw('count(flight_type) as total'))
        ->orderBy('total', 'DESC')
        ->groupBy('flight_type')
        ->paginate(10);
        $groupOfAllFlightsCountriesAndAirports = Flight::select(
            'flight_arrive_airport',
            'flight_leave_country',
            'flight_leave_airport',
            'flight_arrive_country')->distinct()->paginate(10);

        // get all the locations hotels  to show in filter
        $groupLocation = $groupOfAllFlightsCountriesAndAirports->map(function ($location) {
            return [
                'flight_arrive_airport' => $location->flight_arrive_airport,
                'flight_leave_airport' => $location->flight_leave_airport,
            ];
        })->flatten()->unique()->values()->toArray();

        //HOT DEALS AND BEST DISOUNDS
       // Get the count of hotels and packages per country
       $countsByCountry = DB::table('hotels')
       ->select('hotels.loca_country',
       DB::raw('COUNT(DISTINCT hotels.id) as hotel_count'),
       DB::raw('(select count(*) from packages where packages.loca_country=hotels.loca_country
       and packages.status=1) as package_count'))

       ->where('hotels.hotel_status', 1)

       ->groupBy('hotels.loca_country')

       ->take(8)->get();

        return view('Front_End.pages.home.home_page',compact(
            'hotels',
            'packages',
            'groupLocation',
            'flight_type',
        'countsByCountry'));
    }

    //get the disounds of all tables

    public function hotDeals(){
        $hotdeals_packages = Package::orderBy('discound','DESC')->where('discound', '>', 0)->get();
        $hotdeals_hotels = ModelsHotelroom::with('Hotel')->orderBy('discound','DESC')->where('discound', '>', 0)->get();
        $discounds = [];

        foreach ($hotdeals_packages as $package) {
            $discounds[] = [
                'type' => 'package',
                'data' => $package,
            ];
        }

        foreach ($hotdeals_hotels as $hotel) {
            $discounds[] = [
                'type' => 'hotel',
                'data' => $hotel,
            ];
        }
        return view('Front_End.pages.deals.hot_deals',compact('discounds',
        'hotdeals_packages','hotdeals_hotels'));

    }


    public function searchForm(Request $request,$formName){
        $data = $request->all();
        return Search::searchData($formName,$data);

    }

    public function searchFormdata(Request $request){
        $dataALL= $request->all();
        $arrayData = explode('&',$dataALL['data']);
        $resultArray = [];
        foreach ($arrayData as $item) {
            list($key, $value) = explode('=', $item, 2);
            $resultArray[trim($key, '"')] = trim($value, '"');
        }

        $response =  Search::searchData($dataALL['searchName'],$resultArray);
        $data = json_decode(json_encode($response->getData()),true);

        if($dataALL['searchName'] == 'flight_search'){
            $formName = 'flight';

        }elseif($dataALL['searchName'] == 'package_search'){
            $formName = 'package';
            return view('Front_End.pages.search.mainpage',compact('data','formName'));

        }else{
            $formName = 'hotel';
            $hotel = Hotel::where('slug',$data['route_hotel_slug'])->first();
            return view('Front_End.pages.search.mainpage',compact('data','formName','hotel'));
        }
    }
}
