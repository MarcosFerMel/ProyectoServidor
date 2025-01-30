<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/users', [UserController::class, 'index']);


// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de habitaciones
Route::get('/rooms', [RoomController::class, 'index']);      // Listar habitaciones
Route::post('/rooms', [RoomController::class, 'store']);     // Crear habitación
Route::get('/rooms/{id}', [RoomController::class, 'show']);  // Mostrar una habitación
Route::put('/rooms/{id}', [RoomController::class, 'update']); // Actualizar habitación
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']); // Eliminar habitación

// Rutas de reservas
Route::resource('reservations', ReservationController::class);

// Rutas de temporadas
Route::get('/seasons', [SeasonController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
