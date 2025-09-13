<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->resource('usuario',UsuarioController::class)
->names('usuario');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
->group(function () {Route::get('/dashboard', function () {return view('dashboard');})
->name('dashboard');
});
