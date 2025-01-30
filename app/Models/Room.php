<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'type',
        'price',
        'image',
        'season_id'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
