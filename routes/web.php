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
Route::resource('rooms', RoomController::class);

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
