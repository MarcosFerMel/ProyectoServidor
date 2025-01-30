<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'price_multiplier',
        'password',
    ];
}
