<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuarios extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';

    public $timestamps = false;
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'fecha_registro',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}