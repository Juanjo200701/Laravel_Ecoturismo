<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Mostrar todos los lugares
     */
    public function index()
    {
        $places = Place::orderBy('id', 'desc')->get();
        return view('lugares', compact('places'));
    }

    /**
     * Mostrar un lugar específico
     */
    public function show(Place $place)
    {
        return view('place.show', compact('place'));
    }
}

