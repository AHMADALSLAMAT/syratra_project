<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class Flight{


    // create helper to get all flights each 100 togother (for big data)
    public static function flightArray($Models,$orderColumn)
    {
        $flights = [];
            $flightss = $Models::orderBy($orderColumn, 'desc')
            ->get()
            ->unique($orderColumn)
            ->chunk(100)
            ->each(function ($chunk) use (&$flights) {
                foreach ($chunk as $flight) {
                    $flights[] = $flight;
                }
            });
            return $flights;
    }

    // create helper for to calculate Difference Hours return flight
    public static function calculateHoursDifference($leaveDate, $leaveHours, $arriveDate, $arriveHours)
    {
        // Combine date and time for departure and arrival using Carbon
        $leaveDatetime = Carbon::parse("$leaveDate $leaveHours");
        $arriveDatetime = Carbon::parse("$arriveDate $arriveHours");

        // Calculate time difference
        $timeDifference = $arriveDatetime->diff($leaveDatetime);

        // Check if the duration is more than 24 hours
        if ($timeDifference->days > 0) {
            // Format the time difference showing days, hours, and minutes
            $formattedDifference = $timeDifference->format('%a days %hh %im');
        } else {
            // Format the time difference showing only hours and minutes
            $formattedDifference = $timeDifference->format('%hh %im');
        }

        return $formattedDifference;
    }

    // create helper for to calculate Difference Hours for single flight

    public static function calculateDifferenceHours($leaveDate, $arriveDate)
    {
        // Combine date and time for departure and arrival using Carbon
        $leaveDatetime = Carbon::parse("$leaveDate");
        $arriveDatetime = Carbon::parse("$arriveDate");

        // Calculate time difference
        $timeDifference = $arriveDatetime->diff($leaveDatetime);

        // Check if the duration is more than 24 hours
        if ($timeDifference->days > 0) {
            // Format the time difference showing days, hours, and minutes
            $formattedDifference = $timeDifference->format('%a days %hh %im');
        } else {
            // Format the time difference showing only hours and minutes
            $formattedDifference = $timeDifference->format('%hh %im');
        }

        return $formattedDifference;
    }

     // create helper for to convert date
    public static function convertDate($dataTime)
    {
        $date = Carbon::parse($dataTime);
        $formattedDate = $date->format('D d M');
        return $formattedDate;
    }
     // create helper for filter price
     public static function minPrice()
     {
         return floor(\App\Models\Flight::min('flight_price'));
     }

     public static function maxPrice()
     {
         return floor(\App\Models\Flight::max('flight_price'));
     }
}
