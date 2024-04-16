<?php

namespace App\Helpers;

use App\Models\Airport;
use App\Models\City;
use App\Models\Country;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class MyFunctions{

    // get country name

    public static function getCountryName($id,$valueName){
        $country = Country::where('id',$id)->value($valueName);
        return $country;
    }
    public static function getCityName($id,$valueName){
        $city = City::where('id',$id)->value($valueName);
        return $city;
    }

    public static function getAirportData($code,$valueName){
        $Data = Airport::where('code',$code)->value($valueName);
        return $Data;
    }

}
