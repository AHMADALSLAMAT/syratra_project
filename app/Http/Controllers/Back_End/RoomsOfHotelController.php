<?php

namespace App\Http\Controllers\Back_End;

use App\Helpers\Discound;
use App\Models\Hotel;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotelroom;
use Illuminate\Support\Facades\Validator;

class RoomsOfHotelController extends Controller
{
    public function hotels_rooms_index($id)
    {
        $hotel = Hotel::with('Rooms')->find($id);
        return view('Back_End.pages.hotels.rooms.rooms_index', compact('hotel'));
    }
    public function hotels_rooms_add()
    {
        $hotels = Hotel::get();
        return view('Back_End.pages.hotels.rooms.rooms_add',compact('hotels'));
    }
    public function add_more_hotel_room($id){
        $hotel = Hotel::find($id);
        return view('Back_End.pages.hotels.rooms.room_related_to_hotel',compact('hotel'));
    }
    public function hotels_rooms_add_post( Request $request)
    {
        $data = $request->all();
                //save single image
                $validation = Validator::make(
                    $data,
                    [
                        'hotel_name' => 'required',
                        'room_lvl' => 'required',
                        'room_type' => 'required',
                        'room_price' => 'required',
                        'num_rooms' => 'required',
                        'room_image' => 'required',
                    ]
                );
                if ($validation->fails()) {
                    session()->flash('errors', $validation);
                    return back();
                }
                $cover_image = Helper::SaveSingleImage('room_image', $data['room_image']);
                $room_add_gallery = Helper::SaveMultiImages('room_gallery', $data['room_gallery']);
                $amenities_icon = Helper::SaveMultiImages('room_amenities_icon', $data['room_amenities_icon']);
                // remove null from all arrays
                $amenities_title = array_values(array_filter($data['room_amenities_title'], function ($value) {
                    return $value !== null;
                }));

                // remove null from all arrays
                $filter_amenities_icon = array_values(array_filter($amenities_icon, function ($value) {
                    return $value !== null;
                }));

                if(empty($data['offer_price']) || $data['offer_price'] != null){
                    $offerprice = 0;
                    $discound = 0;
                }else{
                    $offerprice = $data['offer_price'];
                    $discound = Discound::calcdiscound($data['room_price'],$data['offer_price']);
                }
                $rooms = new Hotelroom();
                $rooms->hotel_id = $data['hotel_name'];
                $rooms->booking_id = 0;
                $rooms->room_description = $data['room_description'];
                $rooms->room_price = $data['room_price'];
                $rooms->offer_price = $offerprice;
                $rooms->discound = $discound;
                $rooms->room_beds = $data['room_beds'];
                $rooms->num_of_rooms = $data['num_rooms'];
                $rooms->room_amenities_title = $amenities_title;
                $rooms->room_amenities_icon = $filter_amenities_icon;
                $rooms->room_lvl =  $data['room_lvl'];
                $rooms->room_type =  $data['room_type'];
                $rooms->room_image = $cover_image;
                $rooms->room_status = $data['room_status'];
                $rooms->room_gallery = $room_add_gallery;
                if ($rooms->save()) {
                    session()->flash('success', 'Your room has been added successfully !!!!!');
                    return back();
                } else {
                    session()->flash('error', 'Sorry your room data has error !!!!!');
                    return back();
                }
    }
    public function hotels_rooms_edit($id)
    {
        $room = Hotelroom::where('id', $id)->first();
        $hotel = Hotel::where('id', $room->hotel_id)->first();
        if ($room) {
            return view('Back_End.pages.hotels.rooms.rooms_edit', compact('room','hotel'));
        } else {
            session()->flash('error', 'Your Room is not found');
            return back();
        }
    }
    public function hotels_rooms_update(Request $request, $id)
    {
        $data = $request->all();
        //save single image
        $validation = Validator::make(
            $data,
            [
                'hotel_name' => 'required',
                'loca_country' => 'required',
                'loca_city' => 'required',
                'hotel_status' => 'required',
            ]
        );
        // cover image updates
        if (empty($data['room_image']) || $data['room_image'] == null) {
            $cover_image = $data['old_room_image'];
        } else {
            $cover_image = Helper::SaveSingleImage('room_image', $data['room_image']);
        }
        // Gallery image updates
        if (empty($data['old_rooms_gallery']) && empty($data['rooms_gallery'])) {
            session()->flash('error', 'package gallery is required ');
            return back();
        } elseif (empty($data['old_rooms_gallery']) && !empty($data['rooms_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('rooms_gallery', $data['rooms_gallery']);
        } elseif (!empty($data['rooms_gallery']) && !empty($data['old_rooms_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('rooms_gallery', $data['rooms_gallery']);
            $package_add_gallery = array_merge($package_add_gallery, $data['old_rooms_gallery']);
        } else {
            $package_add_gallery = $data['old_rooms_gallery'];
        }
        // amenities_icon image updates
        if (empty($data['old_room_amenities_icon']) && empty($data['room_amenities_icon'])) {
            session()->flash('error', 'amenities icon is required ');
            return back();
        } elseif (empty($data['old_room_amenities_icon']) &&
            !empty($data['room_amenities_icon'] &&
                $data['room_amenities_icon'] != null)) {
            $hotel_amenities_icon = Helper::SaveMultiImages('room_amenities_icon', $data['room_amenities_icon']);
        } elseif (!empty($data['room_amenities_icon']) &&
            !empty($data['old_room_amenities_icon']) &&
            $data['room_amenities_icon'] != null &&
            $data['old_room_amenities_icon'] != null) {
            $hotel_amenities_icon = Helper::SaveMultiImages('room_amenities_icon', $data['room_amenities_icon']);

            $hotel_amenities_icon = array_merge($hotel_amenities_icon, $data['old_room_amenities_icon']);
        } else {
            $hotel_amenities_icon = $data['old_room_amenities_icon'];
        }
        // amenities_title image updates
        $amenities_title = Helper::MerageArrayOnEdidt('room_amenities_title',
            $data['old_room_amenities_title'], $data['room_amenities_title']);
        // remove null from all arrays
        $filtered_amenities_title = array_values(array_filter($amenities_title, function ($value) {
            return $value !== null;
        }));
        // remove null from all arrays
        $filtered_amenities_icon = array_values(array_filter($hotel_amenities_icon, function ($value) {
            return $value !== null;
        }));
        if(empty($data['offer_price']) || $data['offer_price'] == null || $data['offer_price'] == 0 ){
            $offerprice = 0;
            $discound = 0;
        }else{
            //check if the price is smaller than offer price
            if($data['room_price'] < $data['offer_price']){
                session()->flash('error', 'The room Price must be bigger than Offer Price');
                return back();
            }
            $offerprice = $data['offer_price'];
            $discound = Discound::calcdiscound($data['room_price'],$data['offer_price']);
        }

        Hotelroom::where('id', $id)->update([
            'hotel_id' => $data['hotel_name'],
            'booking_id' =>0,
            'room_description' => $data['room_description'],
            'room_price' => $data['room_price'],
            'offer_price' => $offerprice,
            'discound' => $discound,
            'room_amenities_title' => $filtered_amenities_title,
            'room_amenities_icon' => $filtered_amenities_icon,
            'room_beds' => $data['room_beds'],
            'num_of_rooms' => $data['num_rooms'],
            'room_lvl' => $data['room_lvl'],
            'room_type' => $data['room_type'],
            'room_image' => $cover_image,
            'room_status' => $data['status'],
            'room_gallery' => $package_add_gallery,
        ]);
        session()->flash('success', 'The room has been updated');
        return back();
    }
    public function hotels_rooms_delete($id)
    {
        $hotel = Hotelroom::find($id);
        if ($hotel) {
            Hotelroom::where('id', $id)->delete();
            session()->flash('success', 'Your Room has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your Room is not found');
            return back();
        }
    }
}
