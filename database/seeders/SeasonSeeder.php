<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        // Crear temporadas de prueba
        Season::create([
            'name' => 'Temporada Alta',
            'start_date' => '2025-06-01',
            'end_date' => '2025-09-30',
            'price_multiplier' => 1.5
        ]);

        Season::create([
            'name' => 'Temporada Baja',
            'start_date' => '2025-10-01',
            'end_date' => '2025-05-31',
            'price_multiplier' => 1.0
        ]);
    }
}
