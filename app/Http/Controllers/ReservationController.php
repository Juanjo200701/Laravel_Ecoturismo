<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        // El middleware 'auth' ya verifica la autenticación, pero agregamos verificación adicional
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus reservas.');
        }

        $reservations = Reservation::where('user_id', $user->id)
            ->with(['place'])
            ->orderBy('fecha_visita', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    public function create(Place $place)
    {
        return view('reservations.create', compact('place'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
            'fecha_visita' => 'required|date|after_or_equal:today',
            'hora_visita' => 'nullable|date_format:H:i',
            'personas' => 'required|integer|min:1|max:50',
            'telefono_contacto' => 'nullable|string|max:20',
            'comentarios' => 'nullable|string',
            'precio_total' => 'nullable|numeric|min:0',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'place_id' => $data['place_id'],
            'fecha_reserva' => now(),
            'fecha_visita' => $data['fecha_visita'],
            'hora_visita' => $data['hora_visita'] ?? null,
            'fecha' => $data['fecha_visita'], // Mantener compatibilidad
            'personas' => $data['personas'],
            'telefono_contacto' => $data['telefono_contacto'] ?? null,
            'comentarios' => $data['comentarios'] ?? null,
            'precio_total' => $data['precio_total'] ?? null,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('reservations.index')->with('status', 'Reserva creada correctamente.');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->delete();
        return redirect()->route('reservations.index')->with('status', 'Reserva cancelada.');
    }
}
