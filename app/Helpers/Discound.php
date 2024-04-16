<?php

namespace App\Helpers;


class Discound {

    // get the offerprice and calculate the discound before and after

    public static function calcdiscound($price,$offer_price) {
        // Calculate the discount percentage
        $discount_percentage = (($price - $offer_price) / $price) * 100;

        // Return the discount percentage
        return $discount_percentage;
    }

}
