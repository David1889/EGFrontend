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

// Formulario de Alta (Mostrar)
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

// Procesar el Alta (Guardar)
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

// Formulario de Edición (Trae los datos actuales)
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');

// Procesar la Edición (Envía los cambios)
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

// Ruta para procesar la baja (DELETE)
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

// Listar todos los clientes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

// para obtener solo los datos (HTML parcial)
Route::get('/clients/list', [ClientController::class, 'list'])->name('clients.list');