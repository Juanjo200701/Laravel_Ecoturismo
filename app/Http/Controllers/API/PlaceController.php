<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        return response()->json(Place::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $place = Place::create($data);
        return response()->json($place, 201);
    }

    public function show(Place $place)
    {
        return response()->json($place);
    }

    public function update(Request $request, Place $place)
    {
        $data = $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $place->update($data);
        return response()->json($place);
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return response()->json(null, 204);
    }
}