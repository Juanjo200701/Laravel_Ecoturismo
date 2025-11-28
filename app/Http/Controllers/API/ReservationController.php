<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:usuarios,id',
            'place_id' => 'required|exists:places,id',
            'fecha' => 'required|date',
            'personas' => 'required|integer|min:1',
            'estado' => 'required|string',
        ]);

        $reservation = Reservation::create($data);
        return response()->json($reservation, 201);
    }

    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'fecha' => 'date',
            'personas' => 'integer|min:1',
            'estado' => 'string',
        ]);

        $reservation->update($data);
        return response()->json($reservation);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }
}