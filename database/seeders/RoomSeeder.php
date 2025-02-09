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
            'image' => json_encode(['default.jpg', 'default1.jpg', 'default2.jpg']),
            'season_id' => 1
        ]);

        Room::create([
            'name' => 'Suite Presidencial',
            'capacity' => 2,
            'type' => 'suite',
            'price' => 250,
            'image' => json_encode(['default3.jpg', 'default4.jpg', 'default5.jpg']),
            'season_id' => 1
        ]);

        Room::create([
            'name' => 'Habitación Individual',
            'capacity' => 1,
            'type' => 'individual',
            'price' => 80,
            'image' => json_encode(['default6.jpg', 'default7.jpg', 'default8.jpg']),
            'season_id' => 1
        ]);
    }
}
