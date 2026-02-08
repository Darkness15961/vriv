<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\GoogleAuthController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
        Route::delete('delete-account', [AuthController::class, 'deleteUser']);
    });
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/auth/google', [GoogleAuthController::class, 'redirect']);
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);
});

// Rutas protegidas para Eventos, Participaciones y Notificaciones
Route::middleware('auth:api')->group(function () {
    // Eventos
    Route::get('/eventos', [App\Http\Controllers\EventoController::class, 'index']);
    Route::post('/eventos', [App\Http\Controllers\EventoController::class, 'store']);
    Route::get('/eventos/{id}', [App\Http\Controllers\EventoController::class, 'show']);
    Route::put('/eventos/{id}/estado', [App\Http\Controllers\EventoController::class, 'actualizarEstado']);
    Route::put('/eventos/{id}/finalizar', [App\Http\Controllers\EventoController::class, 'finalizar']);
    Route::delete('/eventos/{id}', [App\Http\Controllers\EventoController::class, 'destroy']);

    // Participaciones
    Route::get('/participaciones', [App\Http\Controllers\ParticipacionController::class, 'index']);
    Route::post('/participaciones', [App\Http\Controllers\ParticipacionController::class, 'store']);
    Route::put('/participaciones/{id}/ganador', [App\Http\Controllers\ParticipacionController::class, 'registrarGanador']);
    Route::get('/participaciones/evento/{eventoId}', [App\Http\Controllers\ParticipacionController::class, 'porEvento']);
    Route::get('/participaciones/usuario/{usuarioId}', [App\Http\Controllers\ParticipacionController::class, 'porUsuario']);

    // Notificaciones
    Route::get('/notificaciones/{usuarioId}', [App\Http\Controllers\NotificacionController::class, 'index']);
    Route::post('/notificaciones', [App\Http\Controllers\NotificacionController::class, 'store']);
    Route::put('/notificaciones/{id}/leida', [App\Http\Controllers\NotificacionController::class, 'marcarLeida']);
    Route::get('/notificaciones/{usuarioId}/no-leidas', [App\Http\Controllers\NotificacionController::class, 'noLeidas']);
});
