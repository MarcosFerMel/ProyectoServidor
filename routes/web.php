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

// Página principal (Usuarios NO autenticados)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas accesibles para TODOS (usuarios autenticados y visitantes)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms'); // Deja la API disponible

// Middleware para autenticación de usuarios REGISTRADOS
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 🔹 Rutas para usuarios autenticados (clientes)
    Route::middleware('role:user')->group(function () {
        Route::get('/reservations', Reservations::class)->name('reservations');
    });

    // 🔹 Rutas para administradores (Cambiamos la ruta de /rooms a /admin/rooms)
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/rooms', Rooms::class)->name('admin.rooms'); // Evitamos conflicto de rutas
        Route::get('/admin/reservations', Reservations::class)->name('admin.reservations');
        Route::get('/admin/seasons', Seasons::class)->name('seasons');
        Route::get('/admin/users', Users::class)->name('users');
    });
});

// Rutas API (Para Postman o AJAX)
Route::prefix('api')->group(function () {
    // 🔹 Rutas de habitaciones
    Route::get('/rooms', [RoomController::class, 'index']);
    Route::post('/rooms', [RoomController::class, 'store'])->middleware('role:admin');
    Route::get('/rooms/{id}', [RoomController::class, 'show']);
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->middleware('role:admin');
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->middleware('role:admin');

    // 🔹 Rutas de reservas (solo usuarios autenticados)
    Route::middleware('role:user')->group(function () {
        Route::resource('reservations', ReservationController::class);
    });

    // 🔹 Rutas de temporadas (solo administradores)
    Route::middleware('role:admin')->group(function () {
        Route::get('/seasons', [SeasonController::class, 'index']);
    });

    // 🔹 Rutas de usuarios (solo administradores)
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
    });
});
