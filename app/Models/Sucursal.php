<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursales';
    protected $fillable = [
        'nombre',
        'descripcion',
        'telefono',
        'direccion',
        'foto',
        
    ];
    protected $dates = [
        'fecha',
        'hora'
    ];
}
