<?php

namespace App\Helpers;

class Filter{

    // create helper for filter price
    public static function minPrice()
    {
        return floor(\App\Models\Package::min('price'));
    }

    public static function maxPrice()
    {
        return floor(\App\Models\Package::max('price'));
    }
}
