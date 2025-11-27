<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('pagcentral');
});

// Alias used as post-login landing (keeps compatibility with original app)
Route::get('/pagcentral2', function () {
    return view('pagcentral');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
