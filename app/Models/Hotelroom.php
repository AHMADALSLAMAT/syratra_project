<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotelroom extends Model
{
    use HasFactory;


    public function Hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }


    protected $casts = [
        'room_gallery' => 'array',
        'room_amenities_icon' => 'array',
        'room_amenities_title' => 'array',

    ];
}
