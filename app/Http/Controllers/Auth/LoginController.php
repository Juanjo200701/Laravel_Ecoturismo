<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Procesar intento de login
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $login = $request->input('name');
        $password = $request->input('password');

        // Permitir login por email o por username
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $attempt = Auth::attempt(['email' => $login, 'password' => $password]);
        } else {
            $attempt = Auth::attempt(['name' => $login, 'password' => $password]);
        }

        if ($attempt) {
            $request->session()->regenerate();
            return redirect()->intended(route('pagcentral'));
        }

        return back()->withErrors([
            'name' => 'Las credenciales no coinciden.',
        ])->onlyInput('name');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pagcentral');
    }
}