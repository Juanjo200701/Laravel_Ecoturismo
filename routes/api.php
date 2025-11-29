<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\ReservationController;

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas públicas de lugares (sin autenticación)
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/places/{place}', [PlaceController::class, 'show']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);
    
    // Rutas de lugares (CRUD completo)
    Route::post('/places', [PlaceController::class, 'store']);
    Route::put('/places/{place}', [PlaceController::class, 'update']);
    Route::delete('/places/{place}', [PlaceController::class, 'destroy']);
    
    // Rutas de reservas
    Route::get('/reservations/my', [ReservationController::class, 'myReservations']);
    Route::apiResource('reservations', ReservationController::class);
});