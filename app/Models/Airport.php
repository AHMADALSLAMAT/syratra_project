<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    public function departureFlights()
    {
        return $this->hasMany(Flight::class, 'flight_leave_airport', 'code');
    }

    public function arrivalFlights()
    {
        return $this->hasMany(Flight::class, 'flight_arrive_airport', 'code');
    }
}
