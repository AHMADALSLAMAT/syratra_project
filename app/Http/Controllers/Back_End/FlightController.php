<?php

namespace App\Http\Controllers\Back_End;

use App\Models\Flight;
use App\Helpers\Helper;
use App\Models\Airline;
use App\Models\Airport;
use App\Helpers\Discound;
use App\Helpers\AddNewData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{

    public function flights_index(){

        $flightsChunks = Flight::with('airlines')->paginate(10000);
        return view('Back_End.pages.flights.flights_index',compact('flightsChunks'));
    }

    public function flights_add(){
        $airlines = Airline::where('airline_status',1)->get();
        $airports = Airport::get();

        return view('Back_End.pages.flights.flights_add',compact('airlines','airports'));
    }

    public function flights_add_post(Request $request){
        $data = $request->all();
        //dd($data);
        //save single image
        $validation = Validator::make(
            $data,
            [
                'flight_name' => 'required',
                'flight_price' => 'required',
                'flight_leave_date' => 'required',
                'flight_leave_hours' => 'required',
                'flight_leave_airport' => 'required',
                'flight_arrive_date' => 'required',
                'flight_arrive_hours' => 'required',
                'flight_arrive_airport' => 'required',
            ]
        );
        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }

        $amenities_icon = Helper::SaveMultiImages('flight_amenities_icon', $data['flight_amenities_icon']);

        // remove null from all arrays
        $amenities_title = array_values(array_filter($data['flight_amenities_title'], function ($value) {
            return $value !== null;
        }));

        $flight_stops_country = array_values(array_filter($data['flight_stops_country'], function ($value) {
            return $value !== null;
        }));
        $flight_stops_airport = array_values(array_filter($data['flight_stops_airport'], function ($value) {
            return $value !== null;
        }));
        $flight_stops_date = array_values(array_filter($data['flight_stops_date'], function ($value) {
            return $value !== null;
        }));
        $flight_stops_hours = array_values(array_filter($data['flight_stops_hours'], function ($value) {
            return $value !== null;
        }));


        $LeaveCountry = Airport::where('code', $data['flight_leave_airport'])->value('countryName');
        $arriveCountry = Airport::where('code', $data['flight_arrive_airport'])->value('countryName');
        if($LeaveCountry == 'SYRIA' && $arriveCountry == 'SYRIA'){
            $travel_type = 'Internal';
        }else{
            $travel_type = 'External';
        }

        if($data['flight_return'] == 'returntrip'){
            //offer price
            if(empty($data['offer_price'])
            || $data['offer_price'] == null
            || $data['offer_price'] == 0 )
            {
                $offerprice = 0;
                $discound = 0;
            }else{
                //check if the price is smaller than offer price
                if($data['flight_price'] < $data['offer_price']){
                    session()->flash('error', 'The room Price must be bigger than Offer Price');
                    return back();
                }
                $offerprice = $data['offer_price'];
                $discound = Discound::calcdiscound($data['flight_price'],$data['offer_price']);
            }
              //offer price
              if(empty($data['return_offer_price'])
              || $data['return_offer_price'] == null
              || $data['return_offer_price'] == 0 )
              {
                  $return_offerprice = 0;
                  $return_discound = 0;
              }else{
                  //check if the price is smaller than offer price
                  if($data['return_flight_price'] < $data['return_offer_price']){
                      session()->flash('error', 'The room Price must be bigger than Offer Price');
                      return back();
                  }
                  $return_offerprice = $data['offer_price'];
                  $return_discound = Discound::calcdiscound($data['return_flight_price'],$data['return_offer_price']);
              }
            $return_flight = 1;
            $flight_data = new Flight();
            $flight_data->airline_id = $data['airline_id'];
            $flight_data->flight_name = $data['flight_name'];
            $flight_data->flight_sku = $data['flight_sku'];
            $flight_data->flights_seats = $data['flight_seats'];
            $flight_data->travel_type =   $travel_type ;
            $flight_data->flight_type = $data['flight_type'];
            $flight_data->flight_leave_date = $data['flight_leave_date'];
            $flight_data->flight_leave_hours = $data['flight_leave_hours'];
            $flight_data->flight_leave_country = $LeaveCountry;
            $flight_data->flight_leave_airport = $data['flight_leave_airport'];
            $flight_data->flight_arrive_date = $data['flight_arrive_date'];
            $flight_data->flight_arrive_hours = $data['flight_arrive_hours'];
            $flight_data->flight_arrive_country = $arriveCountry;
            $flight_data->flight_arrive_airport = $data['flight_arrive_airport'];
            $flight_data->flight_stops = $data['flight_stops'];
            $flight_data->flight_stops_country = $flight_stops_country;
            $flight_data->flight_stops_airport = $flight_stops_airport;
            $flight_data->flight_stops_date = $flight_stops_date;
            $flight_data->flight_stops_hours = $flight_stops_hours;
            $flight_data->flight_price = $data['flight_price'];
            $flight_data->offer_price = $offerprice;
            $flight_data->discound = $discound;
            $flight_data->flight_status = $data['flight_status'];
            $flight_data->return_flight = $return_flight;
            $flight_data->flight_amenities_title = $amenities_title;
            $flight_data->flight_amenities_icon = $amenities_icon;
            $flight_data->save();
            $flight_data2 = new Flight();
            $flight_data2->airline_id = $data['airline_id'];
            $flight_data2->flight_name = $data['flight_name'];
            $flight_data2->flight_sku = $data['return_flight_code'];
            $flight_data2->flights_seats = $data['flight_seats'];
            $flight_data2->travel_type =   $travel_type ;
            $flight_data2->flight_type = $data['flight_type'];
            $flight_data2->flight_leave_date = $data['return_flight_leave_date'];
            $flight_data2->flight_leave_hours = $data['return_flight_leave_hours'];
            $flight_data2->flight_leave_country = $arriveCountry;
            $flight_data2->flight_leave_airport = $data['flight_arrive_airport'];
            $flight_data2->flight_arrive_date = $data['return_flight_arrive_date'];
            $flight_data2->flight_arrive_hours = $data['return_flight_arrive_hours'];
            $flight_data2->flight_arrive_country = $LeaveCountry;
            $flight_data2->flight_arrive_airport =  $data['flight_leave_airport'];
            $flight_data2->flight_stops = $data['flight_stops'];
            $flight_data2->flight_stops_country = $flight_stops_country;
            $flight_data2->flight_stops_airport = $flight_stops_airport;
            $flight_data2->flight_stops_date = $flight_stops_date;
            $flight_data2->flight_stops_hours = $flight_stops_hours;
            $flight_data2->flight_price = $data['return_flight_price'];
            $flight_data2->offer_price = $return_offerprice;
            $flight_data2->discound = $return_discound;
            $flight_data2->flight_status = $data['flight_status'];
            $flight_data2->return_flight = $return_flight;
            $flight_data2->flight_amenities_title = $amenities_title;
            $flight_data2->flight_amenities_icon = $amenities_icon;
            if ($flight_data2->save()) {
                session()->flash('success', 'Your Flight has been added successfully !!!!!');
                return back();
            } else {
                session()->flash('error', 'Sorry your Flight data has error !!!!!');
                return back();
            }
        }else{
            //offer price
            if(empty($data['offer_price'])
            || $data['offer_price'] == null
            || $data['offer_price'] == 0 )
            {
                $offerprice = 0;
                $discound = 0;
            }else{
                //check if the price is smaller than offer price
                if($data['flight_price'] < $data['offer_price']){
                    session()->flash('error', 'The room Price must be bigger than Offer Price');
                    return back();
                }
                $offerprice = $data['offer_price'];
                $discound = Discound::calcdiscound($data['flight_price'],$data['offer_price']);
            }
            $return_flight = 0;
            $flight_data = new Flight();
            $flight_data->airline_id = $data['airline_id'];
            $flight_data->flight_name = $data['flight_name'];
            $flight_data->flight_sku = $data['flight_sku'];
            $flight_data->flights_seats = $data['flight_seats'];
            $flight_data->travel_type =   $travel_type ;
            $flight_data->flight_type = $data['flight_type'];
            $flight_data->flight_leave_date = $data['flight_leave_date'];
            $flight_data->flight_leave_hours = $data['flight_leave_hours'];
            $flight_data->flight_leave_country = $LeaveCountry;
            $flight_data->flight_leave_airport = $data['flight_leave_airport'];
            $flight_data->flight_arrive_date = $data['flight_arrive_date'];
            $flight_data->flight_arrive_hours = $data['flight_arrive_hours'];
            $flight_data->flight_arrive_country = $arriveCountry;
            $flight_data->flight_arrive_airport = $data['flight_arrive_airport'];
            $flight_data->flight_stops = $data['flight_stops'];
            $flight_data->flight_stops_country = $flight_stops_country;
            $flight_data->flight_stops_airport = $flight_stops_airport;
            $flight_data->flight_stops_date = $flight_stops_date;
            $flight_data->flight_stops_hours = $flight_stops_hours;
            $flight_data->flight_price = $data['flight_price'];
            $flight_data->offer_price = $offerprice;
            $flight_data->discound = $discound;
            $flight_data->flight_status = $data['flight_status'];
            $flight_data->return_flight = $return_flight;
            $flight_data->flight_amenities_title = $amenities_title;
            $flight_data->flight_amenities_icon = $amenities_icon;
            $flight_data->save();
            if ($flight_data->save()) {
                session()->flash('success', 'Your Flight has been added successfully !!!!!');
                return back();
            } else {
                session()->flash('error', 'Sorry your Flight data has error !!!!!');
                return back();
            }
        }
    }

    public function flights_edit($id){
        $flight = Flight::find($id);
        $airports = Airport::get();
        $airlines = Airline::get();
        return view('Back_End.pages.flights.flights_edit',
        compact('flight','airlines','airports'));
    }

    public function flights_update(Request $request,$id){

        $data = $request->all();
        //save single image

        $validation = Validator::make(
            $data,
            [
                'flight_name' => 'required',
                'flight_price' => 'required',
                'flight_leave_date' => 'required',
                'flight_leave_hours' => 'required',
                'flight_leave_airport' => 'required',
                'flight_arrive_date' => 'required',
                'flight_arrive_hours' => 'required',
                'flight_arrive_airport' => 'required',

            ]
        );

        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
         // amenities_icon image updates
         if (empty($data['old_flight_amenities_icon']) && empty($data['flight_amenities_icon'])) {
            session()->flash('error', 'amenities icon is required ');
            return back();
        } elseif (empty($data['old_flight_amenities_icon']) &&
            !empty($data['flight_amenities_icon'] &&
                $data['flight_amenities_icon'] != null)) {
            $flight_amenities_icon = Helper::SaveMultiImages('package_icons', $data['flight_amenities_icon']);
        } elseif (!empty($data['flight_amenities_icon']) &&
            !empty($data['old_flight_amenities_icon']) &&
            $data['flight_amenities_icon'] != null &&
            $data['old_flight_amenities_icon'] != null) {
            $flight_amenities_icon = Helper::SaveMultiImages('package_icons', $data['flight_amenities_icon']);
            $flight_amenities_icon = array_merge($flight_amenities_icon, $data['old_flight_amenities_icon']);
        } else {
            $flight_amenities_icon = $data['old_flight_amenities_icon'];
        }
        if(!empty($data['old_flight_amenities_title'])){
            $amenities_title = Helper::MerageArrayOnEdidt('flight_amenities_title',
            $data['old_flight_amenities_title'], $data['flight_amenities_title']);
        }else{
            $amenities_title = $data['flight_amenities_title'];
        }

        if(!empty($data['old_flight_stops_country'])){
            $flight_stops_country = Helper::MerageArrayOnEdidt('flight_stops_country',
            $data['old_flight_stops_country'], $data['flight_stops_country']);
        }else{
            $flight_stops_country = $data['flight_stops_country'];
        }
        if(!empty($data['old_flight_stops_airport'])){
            $flight_stops_airport = Helper::MerageArrayOnEdidt('flight_stops_airport',
            $data['old_flight_stops_airport'], $data['flight_stops_airport']);
        }else{
            $flight_stops_airport = $data['flight_stops_airport'];
        }
        if(!empty($data['old_flight_stops_date'])){
            $flight_stops_date = Helper::MerageArrayOnEdidt('flight_stops_date',
            $data['old_flight_stops_date'], $data['flight_stops_date']);
        }else{
            $flight_stops_date = $data['flight_stops_date'];
        }
        if(!empty($data['old_flight_stops_hours'])){
            $flight_stops_hours = Helper::MerageArrayOnEdidt('flight_stops_hours',
            $data['old_flight_stops_hours'], $data['flight_stops_hours']);
        }else{
            $flight_stops_hours = $data['flight_stops_hours'];
        }

        // remove null from all arrays
        $filter_amenities_title = array_values(array_filter($amenities_title, function ($value) {
            return $value !== null;
        }));
        $filter_flight_stops_country = array_values(array_filter($flight_stops_country, function ($value) {
            return $value !== null;
        }));
        $filter_flight_stops_airport = array_values(array_filter($flight_stops_airport, function ($value) {
            return $value !== null;
        }));
        $filter_flight_stops_date = array_values(array_filter($flight_stops_date, function ($value) {
            return $value !== null;
        }));
        $filter_flight_stops_hours = array_values(array_filter($flight_stops_hours, function ($value) {
            return $value !== null;
        }));

        $LeaveCountry = Airport::where('code', $data['flight_leave_airport'])->value('countryName');
        $arriveCountry = Airport::where('code', $data['flight_arrive_airport'])->value('countryName');

        if($LeaveCountry == 'SYRIA' && $arriveCountry == 'SYRIA'){
            $travel_type = 'Internal';
        }else{
            $travel_type = 'External';
        }
         //offer price
         if(empty($data['offer_price'])
         || $data['offer_price'] == null
         || $data['offer_price'] == 0 )
         {
             $offerprice = 0;
             $discound = 0;
         }else{
             //check if the price is smaller than offer price
             if($data['flight_price'] < $data['offer_price']){
                 session()->flash('error', 'The room Price must be bigger than Offer Price');
                 return back();
             }
             $offerprice = $data['offer_price'];
             $discound = Discound::calcdiscound($data['flight_price'],$data['offer_price']);
         }
        $currentFlight = Flight::where('id',$id)->first();
            Flight::where('id', $id)->update([
                'airline_id' => $data['airline_id'],
                'flight_name' => $data['flight_name'],
                'flight_sku' => $data['flight_sku'],
                'flights_seats' => $data['flight_seats'],
                'travel_type' =>   $travel_type ,
                'flight_type' => $data['flight_type'],
                'flight_leave_date' => $data['flight_leave_date'],
                'flight_leave_hours' => $data['flight_leave_hours'],
                'flight_leave_country' => $LeaveCountry,
                'flight_leave_airport' => $data['flight_arrive_airport'],
                'flight_arrive_date' => $data['flight_arrive_date'],
                'flight_arrive_hours' => $data['flight_arrive_hours'],
                'flight_arrive_country' => $arriveCountry,
                'flight_arrive_airport' =>  $data['flight_leave_airport'],
                'flight_stops' => $data['flight_stops'],
                'flight_stops_country' => $filter_flight_stops_country,
                'flight_stops_airport' => $filter_flight_stops_airport,
                'flight_stops_date' => $filter_flight_stops_date,
                'flight_stops_hours' => $filter_flight_stops_hours,
                'flight_price' => $data['flight_price'],
                'offer_price' => $offerprice,
                'discound' => $discound,
                'flight_status' => $data['flight_status'],
                'return_flight' => $currentFlight->return_flight,
                'flight_amenities_title' => $filter_amenities_title,
                'flight_amenities_icon' => $flight_amenities_icon,
            ]);
            session()->flash('success', 'Your Airline has been added successfully !!!!!');
            return back();

    }

    public function airlines_delete($id)
    {
        $airline = Flight::find($id);
        if ($airline) {
            Flight::where('id', $id)->delete();
            session()->flash('success', 'Your package has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your package is not found');
            return back();
        }
    }

}
