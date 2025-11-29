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
            'name' => 'required|string|max:255|min:3|unique:usuarios,name|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'nullable|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'El nombre de usuario es requerido.',
            'name.min' => 'El nombre de usuario debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre de usuario no puede exceder 255 caracteres.',
            'name.unique' => 'Este nombre de usuario ya está en uso.',
            'name.regex' => 'El nombre de usuario solo puede contener letras, números y guiones bajos.',
            'email.email' => 'El email debe ser una dirección válida.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = Usuarios::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'fecha_registro' => now(),
        ]);

        // Crear token de autenticación
        $token = $user->createToken('api-token', ['*'], now()->addDays(30))->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'fecha_registro' => $user->fecha_registro,
                'is_admin' => $user->is_admin,
            ],
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 30 * 24 * 60 * 60, // 30 días en segundos
        ], 201);
    }

    /**
     * Iniciar sesión - Permite login con name o email
     */
    public function login(Request $request): JsonResponse
    {
        // Validar que se proporcione al menos un campo de identificación
        $request->validate([
            'name' => 'required_without:email|string|max:255',
            'email' => 'required_without:name|email|max:255',
            'password' => 'required|string|min:1',
        ], [
            'name.required_without' => 'Debe proporcionar un nombre de usuario o email.',
            'email.required_without' => 'Debe proporcionar un nombre de usuario o email.',
            'email.email' => 'El email debe ser una dirección válida.',
            'password.required' => 'La contraseña es requerida.',
        ]);

        // Buscar usuario por name o email
        $user = null;
        if ($request->filled('name')) {
            $user = Usuarios::where('name', $request->name)->first();
        } elseif ($request->filled('email')) {
            $user = Usuarios::where('email', $request->email)->first();
        }

        // Validar credenciales
        if (!$user) {
            throw ValidationException::withMessages([
                'credentials' => ['Las credenciales proporcionadas son incorrectas.']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['Las credenciales proporcionadas son incorrectas.']
            ]);
        }

        // Crear token de autenticación
        // Revocar tokens anteriores del mismo dispositivo si existe
        $user->tokens()->where('name', 'api-token')->delete();
        
        // Crear nuevo token
        $token = $user->createToken('api-token', ['*'], now()->addDays(30))->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'fecha_registro' => $user->fecha_registro,
                'is_admin' => $user->is_admin,
            ],
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 30 * 24 * 60 * 60, // 30 días en segundos
        ], 200);
    }

    /**
     * Cerrar sesión - Revoca el token actual
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Revocar el token actual
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Sesión cerrada exitosamente'
        ], 200);
    }

    /**
     * Cerrar todas las sesiones - Revoca todos los tokens del usuario
     */
    public function logoutAll(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // Revocar todos los tokens del usuario
        $user->tokens()->delete();
        
        return response()->json([
            'message' => 'Todas las sesiones han sido cerradas exitosamente'
        ], 200);
    }

    /**
     * Obtener información del usuario autenticado
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->load('reservations');
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'fecha_registro' => $user->fecha_registro,
                'is_admin' => $user->is_admin,
                'reservations_count' => $user->reservations->count(),
            ],
            'reservations' => $user->reservations,
        ], 200);
    }

    /**
     * Verificar si el token es válido
     */
    public function verifyToken(Request $request): JsonResponse
    {
        $user = $request->user();
        
        if ($user) {
            return response()->json([
                'valid' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_admin' => $user->is_admin,
                ],
                'message' => 'Token válido'
            ], 200);
        }
        
        return response()->json([
            'valid' => false,
            'message' => 'Token inválido o expirado'
        ], 401);
    }
}