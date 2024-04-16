<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public function Region()
    {
        return  $this->hasMany(Region::class);
    }
    public function City()
    {
        return $this->hasMany(City::class);
    }
    public function Package()
    {
        return $this->hasMany(Package::class);
    }
}
