<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
    public function Region()
    {
        return $this->belongsTo(Region::class);
    }
    public function Package()
    {
        return $this->hasMany(Package::class);
    }
}
