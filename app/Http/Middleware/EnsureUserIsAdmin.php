<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->is_admin) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Acceso denegado. Se requieren permisos de administrador.',
                ], 403);
            }

            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }
}

