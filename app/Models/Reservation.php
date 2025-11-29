<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'place_id',
        'fecha',
        'personas',
        'estado',
    ];

    /**
     * Relación: Una reserva pertenece a un usuario
     */
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'user_id');
    }

    /**
     * Relación: Una reserva pertenece a un lugar
     */
    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}