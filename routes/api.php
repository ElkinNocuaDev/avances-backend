<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HistoriaMedicaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas para Usuarios

// Route::post('usuarios/registro', [UsuarioController::class, 'store']);
Route::post('usuarios/registro', [UsuarioController::class, 'store'])->withoutMiddleware(['jwt.auth']);
Route::post('usuarios/login', [UsuarioController::class, 'login'])->withoutMiddleware(['jwt.auth']);
// Route::post('usuarios/login', [UsuarioController::class, 'login']);


 Route::middleware('jwt.auth')->group(function () {
    Route::get('usuarios/me', [UsuarioController::class, 'getUser']);
    // Otras rutas protegidas para profesionales o pacientes
});

// Mostrar una lista de usuarios
// Route::get('usuarios', [UsuarioController::class, 'index']);
Route::get('usuarios', [UsuarioController::class, 'index'])->withoutMiddleware(['jwt.auth']);

// Crear un nuevo usuario
Route::post('usuarios', [UsuarioController::class, 'store']);

// Mostrar los detalles de un usuario específico
Route::get('usuarios/{id}', [UsuarioController::class, 'show']);

// Actualizar un usuario existente
Route::put('usuarios/{id}', [UsuarioController::class, 'update']);

// Eliminar un usuario
Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);


//Route::resource('usuarios', UsuarioController::class)->except(['create', 'edit']);
// GET /usuarios - Muestra una lista de usuarios.
// POST /usuarios - Crea un nuevo usuario.
// GET /usuarios/{id} - Muestra los detalles de un usuario específico.
// PUT/PATCH /usuarios/{id} - Actualiza un usuario existente.
// DELETE /usuarios/{id} - Elimina un usuario.

// Rutas para Historias Médicas

    // Obtener todas las historias médicas
    // Route::get('historias-medicas', [HistoriaMedicaController::class, 'index']);
    Route::get('historias-medicas', [HistoriaMedicaController::class, 'index'])->withoutMiddleware(['jwt.auth']);

    // Obtener los detalles de una historia médica específica
    Route::get('historias-medicas/{id}', [HistoriaMedicaController::class, 'show']);

    // Crear una nueva historia médica
    // Route::post('historias-medicas', [HistoriaMedicaController::class, 'store']);
    Route::post('historias-medicas', [HistoriaMedicaController::class, 'store'])->withoutMiddleware(['jwt.auth']);

    // Actualizar una historia médica existente
    Route::put('historias-medicas/{id}', [HistoriaMedicaController::class, 'update']);

    // Marcar una historia médica como asistida
    Route::patch('historias-medicas/{id}/marcar-asistida', [HistoriaMedicaController::class, 'marcarAsistida']);

    // Eliminar una historia médica
    Route::delete('historias-medicas/{id}', [HistoriaMedicaController::class, 'destroy']);
