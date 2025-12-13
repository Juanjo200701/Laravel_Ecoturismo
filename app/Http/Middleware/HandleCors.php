<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleCors
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Orígenes permitidos
        $allowedOrigins = [
            'http://localhost:8000',
            'http://127.0.0.1:8000',
            'http://localhost:5173',
            'http://127.0.0.1:5173',
            'http://localhost:3000',
            'http://127.0.0.1:3000',
        ];

        $origin = $request->headers->get('Origin');

        // Si el origen está permitido, usarlo; si no, usar el primero
        $allowedOrigin = in_array($origin, $allowedOrigins) ? $origin : $allowedOrigins[0];

        // Manejar preflight requests
        if ($request->getMethod() === 'OPTIONS') {
            return response('', 200)
                ->header('Access-Control-Allow-Origin', $allowedOrigin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Accept, X-Requested-With')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Max-Age', '86400');
        }

        $response = $next($request);

        // Agregar headers CORS a la respuesta
        return $response
            ->header('Access-Control-Allow-Origin', $allowedOrigin)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, Accept, X-Requested-With')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}

