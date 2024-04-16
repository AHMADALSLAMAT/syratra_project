<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;


    public function airlines(){
        return $this->belongsTo(Airline::class, 'airline_id', 'id');
    }

    public function departureAirport()
    {
        return $this->belongsTo(Airport::class, 'flight_leave_airport', 'code');
    }

    public function arrivalAirport()
    {
        return $this->belongsTo(Airport::class, 'flight_arrive_airport', 'code');
    }

    protected $casts= [
        'flight_stops_country' => 'array',
        'flight_stops_airport' => 'array',
        'flight_stops_date' => 'array',
        'flight_stops_hours' => 'array',
        'flight_amenities_title' => 'array',
        'flight_amenities_icon' => 'array',
    ];
}
