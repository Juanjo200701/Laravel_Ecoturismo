<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    /**
     * Obtener todas las reservas del usuario autenticado
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $reservations = Reservation::where('user_id', $user->id)
            ->with(['place', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($reservations);
    }

    /**
     * Obtener todas las reservas (solo para administradores en el futuro)
     * Por ahora, solo devuelve las del usuario autenticado
     */
    public function all(Request $request): JsonResponse
    {
        $user = $request->user();
        $reservations = Reservation::where('user_id', $user->id)
            ->with(['place', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($reservations);
    }

    /**
     * Crear una nueva reserva
     */
    public function store(Request $request): JsonResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
            'fecha' => 'required|date|after_or_equal:today',
            'personas' => 'required|integer|min:1|max:50',
            'estado' => 'sometimes|string|in:pendiente,confirmada,cancelada',
        ]);

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'place_id' => $data['place_id'],
            'fecha' => $data['fecha'],
            'personas' => $data['personas'],
            'estado' => $data['estado'] ?? 'pendiente',
        ]);

        $reservation->load(['place', 'usuario']);

        return response()->json($reservation, 201);
    }

    /**
     * Obtener una reserva específica
     */
    public function show(Request $request, Reservation $reservation): JsonResponse
    {
        $user = $request->user();

        // Verificar que la reserva pertenece al usuario autenticado
        if ($reservation->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $reservation->load(['place', 'usuario']);

        return response()->json($reservation);
    }

    /**
     * Actualizar una reserva
     */
    public function update(Request $request, Reservation $reservation): JsonResponse
    {
        $user = $request->user();

        // Verificar que la reserva pertenece al usuario autenticado
        if ($reservation->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $data = $request->validate([
            'fecha' => 'sometimes|date|after_or_equal:today',
            'personas' => 'sometimes|integer|min:1|max:50',
            'estado' => 'sometimes|string|in:pendiente,confirmada,cancelada',
        ]);

        $reservation->update($data);
        $reservation->load(['place', 'usuario']);

        return response()->json($reservation);
    }

    /**
     * Eliminar una reserva
     */
    public function destroy(Request $request, Reservation $reservation): JsonResponse
    {
        $user = $request->user();

        // Verificar que la reserva pertenece al usuario autenticado
        if ($reservation->user_id !== $user->id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reserva eliminada correctamente'], 200);
    }

    /**
     * Obtener reservas del usuario autenticado
     */
    public function myReservations(Request $request): JsonResponse
    {
        $user = $request->user();
        $reservations = Reservation::where('user_id', $user->id)
            ->with(['place', 'usuario'])
            ->orderBy('fecha', 'desc')
            ->get();

        return response()->json($reservations);
    }
}