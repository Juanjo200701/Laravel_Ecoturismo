<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registrar un nuevo usuario
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:usuarios,name',
            'email' => 'nullable|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Usuarios::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'fecha_registro' => now(),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Iniciar sesión
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Usuarios::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'name' => ['Las credenciales proporcionadas son incorrectas.']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada exitosamente']);
    }

    /**
     * Obtener información del usuario autenticado
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load('reservations');
        return response()->json($user);
    }
}