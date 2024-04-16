<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    /**
     * Get the options for generating the slug.
     */

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
    public function City()
    {
        return $this->belongsTo(City::class);
    }

    public static function GroupPackage($fieldName, $status)
{
    return Package::select($fieldName, DB::raw('count(*) as total'))
        ->where('status', $status)
        ->groupBy( $fieldName)
        ->get();
}
    protected $casts = [
        'gallery' => 'array',
        'amenities_icon' => 'array',
        'amenities_title' => 'array',
        'itinerary_Day' => 'array',
        'itinerary_title' => 'array',
        'itinerary_desc' => 'array',
    ];
}
