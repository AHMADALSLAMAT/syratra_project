<?php

namespace App\Http\Controllers\Back_End;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function hotels_index()
    {
        $hotels = Hotel::with('Rooms')->get();

        return view('Back_End.pages.hotels.hotels_index', compact('hotels'));
    }
    public function hotels_add()
    {
        return view('Back_End.pages.hotels.hotels_add');
    }
    public function hotels_edit($id)
    {
        $hotel = Hotel::where('id', $id)->first();
        if ($hotel) {
            return view('Back_End.pages.hotels.hotels_edit', compact('hotel'));
        } else {
            session()->flash('error', 'Your Hotel is not found');
            return back();
        }
    }
    public function hotels_add_post(Request $request)
    {
        $data = $request->all();

        //save single image
        $validation = Validator::make(
            $data,
            [
                'hotel_name' => 'required',
                'loca_country' => 'required',
                'loca_city' => 'required',
                'status' => 'required',
                'hotel_image' => 'required',
                'num_rooms' => 'required',
            ]
        );

        //if ($validation->fails()) {
        //    session()->flash('errors', $validation);
        //    return back();
        //}

        $cover_image = Helper::SaveSingleImage('hotel_image', $data['hotel_image']);
        $package_add_gallery = Helper::SaveMultiImages('hotel_gallery', $data['hotel_gallery']);
        $amenities_icon = Helper::SaveMultiImages('hotel_amenities_icon', $data['hotel_amenities_icon']);
        // remove null from all arrays

        $amenities_title = array_values(array_filter($data['hotel_amenities_title'], function ($value) {
            return $value !== null;
        }));

        // remove null from all arrays
        $filter_amenities_icon = array_values(array_filter($amenities_icon, function ($value) {
            return $value !== null;
        }));
        $hotels_data = new Hotel();
        $hotels_data->hotel_name = $data['hotel_name'];
        $hotels_data->slug = Str::slug($data['hotel_name']);
        $hotels_data->hotel_description_small = $data['hotel_description_small'];
        $hotels_data->hotel_description_full = $data['hotel_description_full'];
        $hotels_data->loca_country = $data['loca_country'];
        $hotels_data->loca_city = $data['loca_city'];
        $hotels_data->hotel_amenities_title = $amenities_title;
        $hotels_data->hotel_rooms = $data['num_rooms'];
        $hotels_data->hotel_amenities_icon = $filter_amenities_icon;
        $hotels_data->hotel_map = $data['hotel_map'];
        $hotels_data->hotel_image = $cover_image;
        $hotels_data->hotel_type = $data['hotel_type'];
        $hotels_data->hotel_status = $data['hotel_status'];
        $hotels_data->hotel_gallery = $package_add_gallery;
        if ($hotels_data->save()) {
            session()->flash('success', 'Your Hotel has been added successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Sorry your Hotel data has error !!!!!');
            return back();
        }
    }

    public function hotels_update_package(Request $request, $id)
    {
        //dd($request->all());
        $data = $request->all();
        // check the old data

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
        //if ($validation->fails()) {
        //    session()->flash('errors', $validation);
        //    return back();
        //}
        // cover image updates
        if (empty($data['hotel_image']) || $data['hotel_image'] == null) {
            $cover_image = $data['old_hotel_image'];
        } else {
            $cover_image = Helper::SaveSingleImage('package_cover', $data['hotel_image']);
        }

        // Gallery image updates
        if (empty($data['old_hotel_gallery']) && empty($data['hotel_gallery'])) {
            session()->flash('error', 'package gallery is required ');
            return back();
        } elseif (empty($data['old_hotel_gallery']) && !empty($data['hotel_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('hotel_gallery', $data['hotel_gallery']);
        } elseif (!empty($data['hotel_gallery']) && !empty($data['old_hotel_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('hotel_gallery', $data['hotel_gallery']);
            $package_add_gallery = array_merge($package_add_gallery, $data['old_hotel_gallery']);
        } else {
            $package_add_gallery = $data['old_hotel_gallery'];
        }
        // amenities_icon image updates
        if (empty($data['old_hotel_amenities_icon']) && empty($data['hotel_amenities_icon'])) {
            session()->flash('error', 'amenities icon is required ');
            return back();
        } elseif (empty($data['old_hotel_amenities_icon']) &&
            !empty($data['hotel_amenities_icon'] &&
                $data['hotel_amenities_icon'] != null)) {
            $hotel_amenities_icon = Helper::SaveMultiImages('package_icons', $data['hotel_amenities_icon']);
        } elseif (!empty($data['hotel_amenities_icon']) &&
            !empty($data['old_hotel_amenities_icon']) &&
            $data['hotel_amenities_icon'] != null &&
            $data['old_hotel_amenities_icon'] != null) {
            $hotel_amenities_icon = Helper::SaveMultiImages('package_icons', $data['hotel_amenities_icon']);

            $hotel_amenities_icon = array_merge($hotel_amenities_icon, $data['old_hotel_amenities_icon']);
        } else {
            $hotel_amenities_icon = $data['old_hotel_amenities_icon'];
        }
        // amenities_title image updates
        $amenities_title = Helper::MerageArrayOnEdidt('hotel_amenities_title',
            $data['old_hotel_amenities_title'], $data['hotel_amenities_title']);

        // remove null from all arrays
        $filtered_amenities_title = array_values(array_filter($amenities_title, function ($value) {
            return $value !== null;
        }));
        // remove null from all arrays
        $filtered_amenities_icon = array_values(array_filter($hotel_amenities_icon, function ($value) {
            return $value !== null;
        }));
        Hotel::where('id', $id)->update([
            'hotel_name' => $data['hotel_name'],
            'slug' => Str::slug($data['hotel_name']),
            'hotel_description_small' => $data['hotel_description_small'],
            'hotel_description_full' => $data['hotel_description_full'],
            'loca_country' => $data['loca_country'],
            'loca_city' => $data['loca_city'],
            'hotel_amenities_title' => $filtered_amenities_title,
            'hotel_amenities_icon' => $filtered_amenities_icon,
            'hotel_map' => $data['hotel_map'],
            'hotel_rooms' => $data['num_rooms'],
            'hotel_image' => $cover_image,
            'hotel_status' => $data['status'],
            'hotel_type'=>$data['hotel_type'],
            'hotel_gallery' => $package_add_gallery,
        ]);

        session()->flash('success', 'The Hotel has been updated');
        return back();
    }

    public function hotels_delete($id)
    {
        $hotel = Hotel::find($id);
        if ($hotel) {
            Hotel::where('id', $id)->delete();
            session()->flash('success', 'Your Hotel has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your Hotel is not found');
            return back();
        }
    }
}
