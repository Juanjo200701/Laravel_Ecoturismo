<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceAdminController extends Controller
{
    public function index()
    {
        $places = Place::orderBy('created_at', 'desc')->get();
        return view('admin.places', compact('places'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
        ]);

        Place::create($data);

        return redirect()->route('admin.places.index')->with('status', 'Lugar creado correctamente.');
    }

    public function update(Request $request, Place $place)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:500',
        ]);

        $place->update($data);

        return redirect()->route('admin.places.index')->with('status', 'Lugar actualizado.');
    }

    public function destroy(Place $place)
    {
        $place->delete();

        return redirect()->route('admin.places.index')->with('status', 'Lugar eliminado.');
    }
}

