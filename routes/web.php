<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Vehiculo\VehiculoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Usuarios
    Route::resource('usuario', UsuarioController::class)->names('usuario');

    // Ruta AJAX: buscar usuario por número de documento
    Route::get('/usuarios/buscar-por-documento', [UsuarioController::class, 'buscarPorDocumento'])
        ->name('usuarios.buscarDocumento');

    // Vehículos
    Route::resource('vehiculos', VehiculoController::class)->names('vehiculos');
});
