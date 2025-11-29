<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
    ];

    /**
     * Relación: Un lugar tiene muchas reservas
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'place_id');
    }
}