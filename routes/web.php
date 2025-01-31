<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Rooms;
use App\Livewire\Reservations;
use App\Livewire\Seasons;
use App\Livewire\Users;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Middleware para autenticación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de gestión de habitaciones (Livewire)
    Route::get('/rooms', Rooms::class)->name('rooms');

    // Rutas de gestión de reservas (Livewire)
    Route::get('/reservations', Reservations::class)->name('reservations');

    // Rutas de gestión de temporadas (Livewire)
    Route::get('/seasons', Seasons::class)->name('seasons');

    // Rutas de gestión de usuarios (Livewire)
    Route::get('/users', Users::class)->name('users');
});

// Rutas API (Para Postman o AJAX)
Route::prefix('api')->group(function () {
    // Rutas de habitaciones
    Route::get('/rooms', [RoomController::class, 'index']);
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::get('/rooms/{id}', [RoomController::class, 'show']);
    Route::put('/rooms/{id}', [RoomController::class, 'update']);
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);

    // Rutas de reservas
    Route::resource('reservations', ReservationController::class);

    // Rutas de temporadas
    Route::get('/seasons', [SeasonController::class, 'index']);

    // Rutas de usuarios
    Route::get('/users', [UserController::class, 'index']);
});
