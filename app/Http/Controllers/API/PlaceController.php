<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Place;

class PlaceController extends Controller
{
    /**
     * Obtener todos los lugares (público)
     */
    public function index(): JsonResponse
    {
        $places = Place::orderBy('name', 'asc')->get();
        return response()->json($places);
    }

    /**
     * Crear un nuevo lugar
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
        ]);

        $place = Place::create($data);
        return response()->json($place, 201);
    }

    /**
     * Obtener un lugar específico (público)
     */
    public function show(Place $place): JsonResponse
    {
        $place->load('reservations');
        return response()->json($place);
    }

    /**
     * Actualizar un lugar
     */
    public function update(Request $request, Place $place): JsonResponse
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
        ]);

        $place->update($data);
        return response()->json($place);
    }

    /**
     * Eliminar un lugar
     */
    public function destroy(Place $place): JsonResponse
    {
        $place->delete();
        return response()->json(['message' => 'Lugar eliminado correctamente'], 200);
    }
}