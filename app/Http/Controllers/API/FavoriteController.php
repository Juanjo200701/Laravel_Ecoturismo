<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $favorites = Favorite::where('user_id', $user->id)
            ->with('place')
            ->get();

        return response()->json($favorites);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
        ]);

        // Verificar si ya existe
        $existing = Favorite::where('user_id', $user->id)
            ->where('place_id', $data['place_id'])
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Este lugar ya está en tus favoritos'], 422);
        }

        $favorite = Favorite::create([
            'user_id' => $user->id,
            'place_id' => $data['place_id'],
        ]);

        $favorite->load('place');

        return response()->json($favorite, 201);
    }

    public function destroy(Request $request, $placeId): JsonResponse
    {
        $user = $request->user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('place_id', $placeId)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorito no encontrado'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Eliminado de favoritos']);
    }
}
