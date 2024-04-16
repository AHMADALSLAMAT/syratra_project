<?php

namespace App\Http\Controllers\Back_End;

use App\Models\City;
use App\Models\Region;
use App\Helpers\Helper;
use App\Models\Country;
use App\Models\Package;
use App\Helpers\Discound;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function getCountry()
    {
        $countries = Country::get();
        $data = [
            'status' => 'success',
            'message' => ' your data is working',
            'countries' => $countries,
        ];
        return response()->json($data, 200);
    }
    public function  getState(Request $request)
    {
        $country = $request->all();
        $rogin = Region::where('country_id', $country['country_id'])->get();
        $city = City::where('country_id', $country['country_id'])->get();
        $data = [
            'status' => 'success',
            'message' => ' your data is working',
            'cities' => $city,
        ];
        return response()->json($data, 200);
    }
    public function packages_index()
    {
        $packages = Package::with('Country')->get();

        return view('Back_End.pages.packages.packges_index', compact('packages'));
    }
    public function packages_add()
    {
        return view('Back_End.pages.packages.packages_add');
    }
    public function packages_add_post(Request $request)
    {
        $data = $request->all();

        //save single image
        $validation = Validator::make(
            $data,
            [
                'package_name' => 'required',
                'loca_country' => 'required',
                'loca_city' => 'required',
                'price' => 'required',
                'days' => 'required',
                'status' => 'required',
                'cover_image' => 'required',
            ]
        );

        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
        $cover_image = Helper::SaveSingleImage('package_cover', $data['cover_image']);
        $package_add_gallery = Helper::SaveMultiImages('package_gallery', $data['package_add_gallery']);
        $amenities_icon = Helper::SaveMultiImages('package_icons', $data['amenities_icon']);
                // remove null from all arrays
                $amenities_title = array_values(array_filter($data['amenities_title'], function ($value) {
                    return $value !== null;
                }));

                // remove null from all arrays
                $filter_amenities_icon = array_values(array_filter($amenities_icon, function ($value) {
                    return $value !== null;
                }));

                // remove null from all arrays
                $itinerary_Day = array_values(array_filter($data['itinerary_Day'], function ($value) {
                    return $value !== null;
                }));

                // remove null from all arrays
                $itinerary_title = array_values(array_filter($data['itinerary_title'], function ($value) {
                    return $value !== null;
                }));

                // remove null from all arrays
                $itinerary_desc = array_values(array_filter($data['itinerary_desc'], function ($value) {
                    return $value !== null;
                }));
                if(empty($data['offer_price']) || $data['offer_price'] == null || $data['offer_price'] == 0 ){
                    $offerprice = 0;
                    $discound = 0;
                }else{
                    //check if the price is smaller than offer price
                    if($data['price'] < $data['offer_price']){
                        session()->flash('error', 'The Package Price must be bigger than Offer Price');
                        return back();
                    }
                    $offerprice = $data['offer_price'];
                    $discound = Discound::calcdiscound($data['price'],$data['offer_price']);
                }
        $packages = new Package();
        $packages->name = $data['package_name'];
        $packages->slug = Str::slug($data['package_name']);
        $packages->description_small = $data['small_text'];
        $packages->description_full = $data['full_text'];
        $packages->loca_country = $data['loca_country'];
        $packages->loca_city = $data['loca_city'];
        $packages->amenities_title = $amenities_title;
        $packages->amenities_icon = $filter_amenities_icon;
        $packages->itinerary_Day = $itinerary_Day;
        $packages->itinerary_title = $itinerary_title;
        $packages->itinerary_desc = $itinerary_desc;
        $packages->map = $data['map_url'];
        $packages->days = $data['days'];
        $packages->price = $data['price'];
        $packages->offer_price = $offerprice;
        $packages->discound = $discound;
        $packages->image = $cover_image;
        $packages->status = $data['status'];
        $packages->package_type = $data['package_type'];
        $packages->gallery = $package_add_gallery;
        if ($packages->save()) {
            session()->flash('success', 'Your package has been added successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Sorry your package data has error !!!!!');
            return back();
        }
    }
    public function packages_edit($id)
    {
        $package = Package::where('id', $id)->first();
        if ($package) {
            return view('Back_End.pages.packages.packages_edit', compact('package'));
        } else {
            session()->flash('error', 'Your package is not found');
            return back();
        }
    }
    public function packages_update_package(Request $request, $id)
    {
        //dd($request->all());
        $data = $request->all();
        // check the old data

        //save single image
        $validation = Validator::make(
            $data,
            [
                'package_name' => 'required',
                'loca_country' => 'required',
                'loca_city' => 'required',
                'price' => 'required',
                'days' => 'required',
                'status' => 'required',
            ]
        );
        if ($validation->fails()) {
            session()->flash('errors', $validation);
            return back();
        }
        // cover image updates
        if (empty($data['cover_image']) || $data['cover_image'] == null) {
            $cover_image = $data['old_cover_image'];
        } else {
            $cover_image = Helper::SaveSingleImage('package_cover', $data['cover_image']);
        }

        // Gallery image updates
        if (empty($data['old_gallery']) && empty($data['package_add_gallery'])) {
            session()->flash('error', 'package gallery is required ');
            return back();
        } elseif (empty($data['old_gallery']) && !empty($data['package_add_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('package_add_gallery', $data['package_add_gallery']);
        } elseif (!empty($data['package_add_gallery']) && !empty($data['old_gallery'])) {
            $package_add_gallery = Helper::SaveMultiImages('package_add_gallery', $data['package_add_gallery']);
            $package_add_gallery = array_merge($package_add_gallery, $data['old_gallery']);
        } else {
            $package_add_gallery = $data['old_gallery'];
        }
        // amenities_icon image updates
        if (empty($data['old_amenities_icon']) && empty($data['amenities_icon'])) {
            session()->flash('error', 'amenities icon is required ');
            return back();
        } elseif (empty($data['old_amenities_icon']) && !empty($data['amenities_icon'] && $data['amenities_icon'] != null)) {
            $amenities_icon = Helper::SaveMultiImages('package_icons', $data['amenities_icon']);
        } elseif (!empty($data['amenities_icon']) && !empty($data['old_amenities_icon']) && $data['amenities_icon'] != null && $data['old_amenities_icon'] != null) {
            $amenities_icon = Helper::SaveMultiImages('package_icons', $data['amenities_icon']);

            $amenities_icon = array_merge($amenities_icon, $data['old_amenities_icon']);
        } else {
            $amenities_icon = $data['old_amenities_icon'];
        }
        // amenities_title image updates
        $amenities_title = Helper::MerageArrayOnEdidt('amenities_title',$data['old_amenities_title'],$data['amenities_title']);
        $itinerary_Day = Helper::MerageArrayOnEdidt('itinerary_Day',$data['old_itinerary_Day'],$data['itinerary_Day']);
        $itinerary_title = Helper::MerageArrayOnEdidt('amenities_title',$data['old_itinerary_title'],$data['itinerary_title']);
        $itinerary_desc = Helper::MerageArrayOnEdidt('amenities_title',$data['old_itinerary_desc'],$data['itinerary_desc']);

                // remove null from all arrays
            $filtered_amenities_title = array_values(array_filter($amenities_title, function ($value) {
                return $value !== null;
            }));
            // remove null from all arrays
            $filtered_amenities_icon = array_values(array_filter($amenities_icon, function ($value) {
                return $value !== null;
            }));
            // remove null from all arrays
            $filtered_itinerary_Day = array_values(array_filter($itinerary_Day, function ($value) {
                return $value !== null;
            }));
            // remove null from all arrays
            $filtered_itinerary_title = array_values(array_filter($itinerary_title, function ($value) {
                return $value !== null;
            }));
            // remove null from all arrays
            $filtered_itinerary_desc = array_values(array_filter($itinerary_desc, function ($value) {
                return $value !== null;
            }));
            if(empty($data['offer_price']) || $data['offer_price'] == null || $data['offer_price'] == 0 ){
                $offerprice = 0;
                $discound = 0;
            }else{
                //check if the price is smaller than offer price
                if($data['price'] < $data['offer_price']){
                    session()->flash('error', 'The Package Price must be bigger than Offer Price');
                    return back();
                }
                $offerprice = $data['offer_price'];
                $discound = Discound::calcdiscound($data['price'],$data['offer_price']);
            }
            Package::where('id', $id)->update([
                'name' => $data['package_name'],
                'slug' => Str::slug($data['package_name']),
                'description_small' => $data['small_text'],
                'description_full' => $data['full_text'],
                'loca_country' => $data['loca_country'],
                'loca_city' => $data['loca_city'],
                'amenities_title' => $filtered_amenities_title,
                'amenities_icon' => $filtered_amenities_icon,
                'itinerary_Day' => $filtered_itinerary_Day,
                'itinerary_title' => $filtered_itinerary_title,
                'itinerary_desc' => $filtered_itinerary_desc,
                'map' => $data['map_url'],
                'price' => $data['price'],
               'offer_price' => $offerprice,
               'discound' => $discound,
                'image' => $cover_image,
                'days' => $data['days'],
                'status' => $data['status'],
                'gallery' => $package_add_gallery,
                'package_type' => $data['package_type'],
            ]);

            session()->flash('success', 'The package has been updated');
            return back();
    }
    public function packages_delete($id)
    {
        $package = Package::find($id);
        if ($package) {
            Package::where('id', $id)->delete();
            session()->flash('success', 'Your package has been deleted successfully !!!!!');
            return back();
        } else {
            session()->flash('error', 'Your package is not found');
            return back();
        }
    }
}
