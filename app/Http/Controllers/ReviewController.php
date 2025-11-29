<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Verificar que el usuario no haya comentado antes este lugar
        $existingReview = Review::where('user_id', Auth::id())
            ->where('place_id', $data['place_id'])
            ->first();

        if ($existingReview) {
            return back()->withErrors(['review' => 'Ya has comentado este lugar. Solo puedes comentar una vez por lugar.']);
        }

        Review::create([
            'user_id' => Auth::id(),
            'place_id' => $data['place_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
            'fecha_comentario' => now(),
        ]);

        return back()->with('status', 'Comentario agregado correctamente.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();
        return back()->with('status', 'Comentario eliminado.');
    }
}
