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

    /**
     * Devuelve un array de imágenes si están almacenadas como JSON en la BD.
     */
    public function getImagesAttribute()
{
    if (is_null($this->image) || $this->image === '') {
        return ['default.jpg']; // Imagen por defecto si no hay imágenes
    }
    
    $decoded = json_decode($this->image, true);
    return is_array($decoded) ? $decoded : ['default.jpg'];
}

}
