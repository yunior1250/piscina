<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'fecha_ini',
        'fecha_fin',
        'ambinete_id',
        'user_id'
    ];
    protected $dates = [
        'fecha',
        'hora'
    ];
}