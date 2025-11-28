<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('registro');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:usuarios,name',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Usuarios::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('status', 'Registro exitoso. Puedes iniciar sesión.');
    }
}
