<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public function Country()
    {
        return  $this->belongsTo(Country::class);
    }
    public function City()
    {
        return $this->belongsTo(City::class);
    }
}
