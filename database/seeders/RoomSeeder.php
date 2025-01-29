<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::create([
            'name' => 'Habitación Familiar',
            'capacity' => 4,
            'type' => 'familiar',
            'price' => 120,
            'image' => 'default.jpg',
            'season_id' => 1
        ]);

        Room::create([
            'name' => 'Suite Presidencial',
            'capacity' => 2,
            'type' => 'suite',
            'price' => 250,
            'image' => 'default.jpg',
            'season_id' => 1
        ]);
    }
}
