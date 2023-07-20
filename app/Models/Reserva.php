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
        'fecha', 
        'hora_inicio',
        'hora_final',
        'ambinete_id',
        'user_id'
    ];
    protected $dates = [
        'fecha',
        'hora'
    ];

 /*    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class, 'ambiente_id');
    } */
}