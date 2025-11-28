<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('pagcentral');
});

// Alias used as post-login landing (keeps compatibility with original app)
Route::get('/pagcentral2', function () {
    return view('pagcentral');
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
Route::view('/lugares', 'lugares')->name('lugares');
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
