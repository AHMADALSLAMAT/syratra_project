<?php

namespace App\Http\Controllers\Front_End;

use App\Models\Flight;
use App\Models\Airline;
use App\Helpers\MyFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\Flight as HelperFlight;
use App\Helpers\FlightSearch;
use App\Helpers\Helper;
use App\Models\Airport;

class FlightController extends Controller
{
    public function view_flight()
    {
        // hotel filter in hotel page get the data from the link top
        $flights = Flight::query();
        if (!empty($_GET['flight_stops'])) {
            $counts = explode(',', $_GET['flight_stops']);
            $flights = $flights->whereIn(DB::raw('JSON_LENGTH(flight_stops_country)'), $counts);
        }

        if (!empty($_GET['flight_type'])) {
            $flight_type = explode(',', $_GET['flight_type']);
            $flights = $flights->whereIn('flight_type', $flight_type);
        }

        if (!empty($_GET['flight_leave_country'])) {
            $flight_location_leave = explode(',', $_GET['flight_leave_country']);
            $flights = $flights->whereIn('flight_leave_country', $flight_location_leave);
        }

        if (!empty($_GET['flight_arrive_airport'])) {
            $location_arrive = explode(',', $_GET['flight_arrive_airport']);
            $flights = $flights->whereIn('flight_arrive_airport', $location_arrive);
        }

        if (!empty($_GET['travel_type'])) {
            $travel_type = explode(',', $_GET['travel_type']);
            $flights = $flights->whereIn('travel_type', $travel_type);
        }
        // price filter
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $flights = $flights->whereBetween('flight_price', $price);
        }

        // FILTER DATA GET ALL OF THEM.
        // get all the internal hotels and external hotels to show in filter
        $flight_stops = Flight::select('flight_stops', DB::raw('count(flight_stops) as total'))
        ->orderBy('total', 'DESC')
            ->groupBy('flight_stops')
            ->take(10);
        $flight_type = Flight::select('flight_type', DB::raw('count(flight_type) as total'))
        ->orderBy('total', 'DESC')
            ->groupBy('flight_type')
            ->paginate(10);
            $travel_type = Flight::select('travel_type', DB::raw('count(travel_type) as total'))
            ->orderBy('total', 'DESC')
            ->groupBy('travel_type')
            ->paginate(10);
        // get all the locations hotels  to show in filter
        $flight_arrive_country = Flight::select('flight_arrive_airport',
            DB::raw('count(flight_arrive_airport) as total'))
            ->orderBy('total', 'DESC')
            ->groupBy('flight_arrive_airport')
            ->paginate(10);

            $flight_leave_country = Flight::select(
                'flight_leave_country',
                DB::raw('COUNT(flight_leave_country) AS total')
            )
            ->orderBy('total', 'DESC')
            ->groupBy('flight_leave_country')
            ->take(10)
            ->get();
            $flights = $flights->with(['airlines','departureAirport','arrivalAirport'])->where('flight_status', 1)
            ->paginate(10);
            $upcomingFlights = Flight::orderBy('flight_leave_date', 'ASC')->where('flight_leave_date', '>', now())->paginate(20);
            $formattedFlights = $upcomingFlights->map(function ($flight) {
                $formattedLeaveDate = Carbon::parse($flight->flight_leave_date)->format('D, d M');
                $flight->formatted_leave_date = $formattedLeaveDate;
                return $flight;
            });
            $airports = [];

            $airportss = Airport::
            select('code','countryName','name')->
            orderBy('code', 'desc')->get()->unique('code')->chunk(100)->each(function ($chunk) use (&$airports) {
                foreach ($chunk as $airport) {
                    $airports[] = $airport;
                }
            });
        return view('Front_End.pages.flights.flights-list',
                compact(
                    'flights',
                'airports',
                'formattedFlights',
                'flight_stops',
                'flight_type',
                'flight_arrive_country',
                'flight_leave_country',
                'travel_type'
                ));
    }

    // Left Filter For Flight
    public function flight_filter(Request $request){
        $data = $request->all();
        // Days filter
         $catUrl = '';
         if(!empty($data['flight_stops'])){
             foreach($data['flight_stops'] as $hotel){
                 if(empty($catUrl)){
                     $catUrl.='&flight_stops='.$hotel;
                 }else{
                     $catUrl.=','.$hotel;
                 }
             }
         }

         // Type filter
         $flight_type = '';
         if(!empty($data['flight_type'])){
             foreach($data['flight_type'] as $type){
                 if(empty($flight_type)){
                     $flight_type.='&flight_type='.$type;
                 }else{
                     $flight_type.=','.$type;
                 }
             }
         }
           // travel Type filter
           $travel_type = '';
           if(!empty($data['travel_type'])){
               foreach($data['travel_type'] as $type){
                   if(empty($travel_type)){
                       $travel_type.='&travel_type='.$type;
                   }else{
                       $travel_type.=','.$type;
                   }
               }
           }
         // Location filter
         $flight_arrive_airport = '';
         if(!empty($data['flight_arrive_airport'])){
             foreach($data['flight_arrive_airport'] as $lcoation){
                 if(empty($flight_arrive_airport)){
                     $flight_arrive_airport.='&flight_arrive_airport='.$lcoation;
                 }else{
                     $flight_arrive_airport.=','.$lcoation;
                 }
             }
         }
          // Airport filter
          $flight_leave_country = '';
          if(!empty($data['flight_leave_country'])){
              foreach($data['flight_leave_country'] as $lcoation){
                  if(empty($flight_leave_country)){
                      $flight_leave_country.='&flight_leave_country='.$lcoation;
                  }else{
                      $flight_leave_country.=','.$lcoation;
                  }
              }
          }
         // price filter
        if (!empty($data['min_price']) || !empty($data['max_price'])) {
            if ($data['min_price'] < HelperFlight::minPrice() ||
                $data['max_price'] > HelperFlight::maxPrice() ||
                $data['min_price'] > $data['max_price']) {
                return back()->with(
                    'error',
                    'The Price Rang is Not Correct, Search between '. HelperFlight::minPrice() .' And '. HelperFlight::maxPrice());
            }
            if ($data['min_price'] == null || empty($data['min_price'])) {
                $minPrice = HelperFlight::minPrice();
            } else {
                $minPrice = $data['min_price'];
            }
            if ($data['max_price'] == null || empty($data['max_price'])) {
                $maxPrice = HelperFlight::maxPrice();
            } else {
                $maxPrice = $data['max_price'];
            }
            //filter price
            $price = $minPrice.'-'.$maxPrice;
        }
        $price_range_url='';

        if(!empty($price)){
            $price_range_url.='&price='.$price;
        }
        $page='';
        if(!empty($data['page'])){
            foreach($data['page'] as $lcoation){
                if(empty($page)){
                    $page.='&page='.$lcoation;
                }else{
                    $page.=','.$lcoation;
                }
            }
        }
         return redirect()->route('view_flight', $catUrl.$flight_type.$travel_type.$flight_leave_country.$flight_arrive_airport.$price_range_url.$page);
    }

    // Filter For Search top flight
    public function flight_searchFormdata(Request $request){
        $data = $request->all();

        $resultSearch = FlightSearch::getFlightBasedOnTravelDate(
            $data['trip_type'],
            $data['flight_leave_country'],
            $data['flight_arrive_country'],
            $data['flight_leave_date'],
            $data['flight_return_date']);
        return view('Front_End.pages.flights.flight_search_database',compact('resultSearch'));
    }
}
