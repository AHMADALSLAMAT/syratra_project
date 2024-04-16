<?php

namespace App\Helpers;

class Dataoforder{

    // create helper for filter price
    public static function Checktheorderdata($orderdata)
    {
        // get the data of orders

        if($orderdata->flight_id != null){
            return 'Flight';
        }elseif($orderdata->package_id != null){
            return 'Package';
        }elseif($orderdata->hotel_id != null){
            return 'Hotel';
        }
    }
}
