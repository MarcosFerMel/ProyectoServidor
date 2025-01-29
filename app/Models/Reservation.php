<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'check_in', 'check_out', 'status'
    ];

    // Relación con la tabla users
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Relación con la tabla rooms
    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}
