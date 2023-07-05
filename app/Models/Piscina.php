<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piscina extends Model
{
    use HasFactory;
    protected $table = 'piscinas';
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'largo', 'ancho', 'profundidad', 'radio', 'volumen','imagen'];



    public function calcularVolumen()
    {
        if ($this->tipo === 'rectangular') {
            return $this->calcularVolumenRectangular();
        } elseif ($this->tipo === 'circular') {
            return $this->calcularVolumenCircular();
        }

        // Agrega otros tipos de piscinas y sus respectivos cálculos de volumen aquí

        return 0; // Tipo de piscina desconocido
    }

    private function calcularVolumenRectangular()
    {
        return $this->largo * $this->ancho * $this->profundidad;
    }

    private function calcularVolumenCircular()
    {
        return pi() * pow($this->radio, 2) * $this->profundidad;
    }
}
