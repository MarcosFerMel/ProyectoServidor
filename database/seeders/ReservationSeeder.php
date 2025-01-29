<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Room;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Verificar que hay usuarios y habitaciones antes de poblar reservas
        if (User::count() == 0 || Room::count() == 0) {
            return;
        }

        // Crear 5 reservas aleatorias
        for ($i = 0; $i < 5; $i++) {
            Reservation::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'room_id' => Room::inRandomOrder()->first()->id,
                'check_in' => now()->addDays(rand(1, 10)),
                'check_out' => now()->addDays(rand(11, 20)),
                'status' => 'confirmed',
            ]);
        }
    }
}
