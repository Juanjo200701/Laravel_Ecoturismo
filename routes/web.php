<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PlaceAdminController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('pagcentral');
})->name('pagcentral');

// Rutas públicas de lugares
Route::get('/lugares', [PlaceController::class, 'index'])->name('lugares');
Route::get('/lugares/{place}', [PlaceController::class, 'show'])->name('place.show');

// Rutas públicas de categorías
Route::get('/categoria/{category}', [CategoryController::class, 'show'])->name('category.show');

Route::middleware('auth')->group(function () {
    // Rutas de usuarios
    Route::get('/reservas', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservas/crear/{place}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservas', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservas/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/favoritos', function() {
        $favorites = \App\Models\Favorite::where('user_id', Auth::id())
            ->with('place')
            ->get();
        return view('favorites.index', compact('favorites'));
    })->name('favorites.index');
    
    Route::post('/favoritos', function(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
        ]);
        
        $existing = \App\Models\Favorite::where('user_id', Auth::id())
            ->where('place_id', $data['place_id'])
            ->first();
            
        if ($existing) {
            return back()->with('error', 'Este lugar ya está en tus favoritos');
        }
        
        \App\Models\Favorite::create([
            'user_id' => Auth::id(),
            'place_id' => $data['place_id'],
        ]);
        
        return back()->with('status', 'Agregado a favoritos');
    })->name('favorites.store');
    
    Route::delete('/favoritos/{place}', function(\App\Models\Place $place) {
        \App\Models\Favorite::where('user_id', Auth::id())
            ->where('place_id', $place->id)
            ->delete();
        return back()->with('status', 'Eliminado de favoritos');
    })->name('favorites.destroy');
    
    // Rutas de comentarios/reseñas
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Rutas de admin
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/places', [PlaceAdminController::class, 'index'])->name('places.index');
        Route::post('/places', [PlaceAdminController::class, 'store'])->name('places.store');
        Route::post('/places/upload', [PlaceAdminController::class, 'upload'])->name('places.upload');
        Route::put('/places/{place}', [PlaceAdminController::class, 'update'])->name('places.update');
        Route::delete('/places/{place}', [PlaceAdminController::class, 'destroy'])->name('places.destroy');
        
        Route::get('/reservations', [ReservationAdminController::class, 'index'])->name('reservations.index');
        Route::put('/reservations/{reservation}', [ReservationAdminController::class, 'update'])->name('reservations.update');
        Route::delete('/reservations/{reservation}', [ReservationAdminController::class, 'destroy'])->name('reservations.destroy');
        
        Route::get('/categories', [CategoryAdminController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryAdminController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryAdminController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryAdminController::class, 'destroy'])->name('categories.destroy');
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