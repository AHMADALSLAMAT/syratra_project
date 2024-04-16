<?php

namespace App\Models;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nahotel_nameme')
            ->saveSlugsTo('slug');
    }
    public function Rooms(){
        return $this->hasMany(Hotelroom::class,'hotel_id');
    }
    protected $casts = [
        'hotel_gallery' => 'array',
        'hotel_amenities_icon' => 'array',
        'hotel_amenities_title' => 'array',

    ];
}
