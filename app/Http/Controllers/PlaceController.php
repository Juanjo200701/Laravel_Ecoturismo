<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $reviews = Review::where('place_id', $place->id)
            ->with('usuario:id,name')
            ->orderBy('fecha_comentario', 'desc')
            ->get();
        
        $averageRating = $reviews->avg('rating') ?? 0;
        $userReview = null;
        
        if (Auth::check()) {
            $userReview = Review::where('user_id', Auth::id())
                ->where('place_id', $place->id)
                ->first();
        }
        
        return view('place.show', compact('place', 'reviews', 'averageRating', 'userReview'));
    }
}

