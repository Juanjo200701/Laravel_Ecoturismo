<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PlaceController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\PaymentController;

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Rutas públicas de lugares (sin autenticación)
Route::get('/places', [PlaceController::class, 'index']);
Route::get('/places/{place}', [PlaceController::class, 'show']);

// Rutas protegidas con Sanctum
// Añadimos un prefijo de nombre `api.` para evitar colisiones con las rutas web
Route::middleware('auth:sanctum')->name('api.')->group(function () {
    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    Route::get('/user', [AuthController::class, 'me']);
    Route::get('/verify-token', [AuthController::class, 'verifyToken']);
    
    // Rutas de lugares (CRUD completo)
    Route::post('/places', [PlaceController::class, 'store'])->middleware('admin');
    Route::put('/places/{place}', [PlaceController::class, 'update'])->middleware('admin');
    Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->middleware('admin');
    
    // Rutas de reservas
    Route::get('/reservations/my', [ReservationController::class, 'myReservations']);
    Route::apiResource('reservations', ReservationController::class);
    
    // Rutas de comentarios/reseñas
    Route::get('/places/{placeId}/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
    
    // Rutas de favoritos
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{placeId}', [FavoriteController::class, 'destroy']);
    
    // Rutas de pagos (BOCETO)
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);
});