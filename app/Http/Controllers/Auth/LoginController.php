<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        // Validar campos requeridos
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'name.required' => 'El nombre de usuario o email es requerido.',
            'password.required' => 'La contraseña es requerida.',
        ]);

        $login = $request->input('name');
        $password = $request->input('password');

        // Buscar usuario por email o por name
        $user = null;
        $user = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? Usuarios::where('email', $login)->first()
            : Usuarios::where('name', $login)->first();

        // Validar credenciales
        if (!$user) {
            return back()->withErrors([
                'credentials' => 'Las credenciales proporcionadas son incorrectas.',
            ])->onlyInput('name');
        }

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors([
                'credentials' => 'Las credenciales proporcionadas son incorrectas.',
            ])->onlyInput('name');
        }

        // Autenticar usuario
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('pagcentral'))->with('status', '¡Bienvenido de nuevo!');
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