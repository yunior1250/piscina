<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    protected $table = 'ambientes';
    protected $fillable = [
        'nombre',
        'descripcion',
        'capasidad',
        'ocupado',
        'foto',
        'sucursal_id'
    ];
    protected $dates = [
        'fecha',
        'hora'
    ];
}
