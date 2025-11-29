<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PlaceAdminController;
use App\Http\Controllers\PlaceController;

Route::get('/', function () {
    return view('pagcentral');
})->name('pagcentral');

// Rutas públicas de lugares
Route::get('/lugares', [PlaceController::class, 'index'])->name('lugares');
Route::get('/lugares/{place}', [PlaceController::class, 'show'])->name('place.show');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/places', [PlaceAdminController::class, 'index'])->name('places.index');
        Route::post('/places', [PlaceAdminController::class, 'store'])->name('places.store');
        Route::post('/places/upload', [PlaceAdminController::class, 'upload'])->name('places.upload');
        Route::put('/places/{place}', [PlaceAdminController::class, 'update'])->name('places.update');
        Route::delete('/places/{place}', [PlaceAdminController::class, 'destroy'])->name('places.destroy');
    });
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout (POST) handled by LoginController
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registro: show form y procesar registro
Route::get('/registro', [RegisterController::class, 'create'])->name('registro');
Route::post('/registro', [RegisterController::class, 'store'])->name('registro.store');

// Rutas para vistas estáticas usadas en la UI
Route::view('/comentarios', 'comentarios')->name('comentarios');
Route::view('/comentarios2', 'comentarios2')->name('comentarios2');
Route::view('/contacto', 'contacto')->name('contacto');

// Carga automática de rutas generadas para todas las vistas en resources/views
if (file_exists(__DIR__ . '/views_generated.php')) {
    require __DIR__ . '/views_generated.php';
}

// Manejo simple de envío de mensajes desde la vista de comentarios
Route::post('/mensajes', function (Request $request) {
    // Aquí podrías validar y guardar el mensaje en BD o enviarlo por correo.
    // Por ahora simplemente redirigimos con un mensaje de sesión.
    return redirect()->route('comentarios')->with('status', 'Mensaje enviado correctamente');
})->name('mensajes');