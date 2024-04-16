<?php
namespace App\Helpers;

use App\Models\Hotel;
use App\Models\Hotelroom;
use App\Models\Package;

// this function for Travel Search

class Search{
    public static function searchData($form_requested , $dataOfSearch){
        // the Hotel Search Form
        if($form_requested == 'hotel_search'){
            // check the hotel if its exists
            $check_hotel_name = Hotel::where('slug',$dataOfSearch['hotel_name'])->count();
            if($check_hotel_name > 0 ){
                // get the hotel data and the rooms related to
                $hotel_data = Hotel::with('Rooms')->where('slug',$dataOfSearch['hotel_name'])->first();
                // find the room that related to request
                $route_hotel = $hotel_data->slug;
                $rooms_ids = array();
                foreach($hotel_data->rooms as $room){
                    $selected_room = Hotelroom::where('id',$room->id)
                    ->where('hotel_id',$hotel_data->id)
                    ->where('booking_id', 0)
                    ->where('room_status', 1)
                    ->where('room_beds', '>=', $dataOfSearch['number_of_gusts'])
                    ->where('num_of_rooms', '>=', $dataOfSearch['number_of_rooms'])
                    ->first();
                array_push($rooms_ids, $selected_room);
                }
                // remove the null from rooms
                    $rooms_data = array_values(array_filter($rooms_ids, function ($value) {
                            return $value !== null;
                    }));
                if(count($rooms_data) == 0 ){
                    $rooms_data = 'there are no matching rooms';
                }
                return response()->json(
                    [
                        'route_hotel_slug'=>$route_hotel,
                        'rooms_ids'=>$rooms_data,
                        'formname'=>'hotel',
                        'status'=>'success',
                        'message'=>'the data has been recived']
                    ,200);
            }else{
                return response()->json(['status'=>'faild','message'=>'please enter a hotel name'],404);
            }
        }
        // the Package Search Form
        if($form_requested == 'package_search'){
            $check_package_data = Package::where('loca_country',$dataOfSearch['package_country'])
            ->where('days',$dataOfSearch['days'])->count();
            if($check_package_data > 0 ){
                $package_data = Package::where('loca_country',$dataOfSearch['package_country'])
            ->where('days',$dataOfSearch['days'])->get();
            $route_hotel = 'packages';
            return response()->json(
                [
                    'packages'=>$route_hotel,
                    'package_data'=>$package_data,
                    'status'=>'success',
                    'formname'=>'package',
                    'message'=>'the data has been recived']
                ,200);
            }else{
                return response()->json(['status'=>'faild','message'=>'Sorry, there are no packages related to your request now'],200);
            }
        }
        // the Flight Search Form
        if($form_requested == 'flight_search'){
            return response()->json(['data'=>$dataOfSearch,'status'=>'success','message'=>'please enter a hotel name'],200);
        }
    }

}
