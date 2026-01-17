<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de Autenticación
// Mostrar el formulario (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesar el formulario (POST)
Route::post('/login', [AuthController::class, 'login']); 

// Ruta para salir de la sesión (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// CLIENTES
// Listar todos los clientes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

// para obtener solo los datos (HTML parcial)
Route::get('/clients/list', [ClientController::class, 'list'])->name('clients.list');