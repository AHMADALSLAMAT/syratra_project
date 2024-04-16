<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Adminsuper extends Authenticatable
{
    use HasFactory;

    // You can set the guard property if needed, although it's not necessary in this case.
    protected $guard = 'admin';
}
