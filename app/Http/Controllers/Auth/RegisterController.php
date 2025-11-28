<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
            'username' => 'required|string|max:255|unique:usuarios,username',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('status', 'Registro exitoso. Puedes iniciar sesión.');
    }
}
