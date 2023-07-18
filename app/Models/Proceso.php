<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;
    protected $table = 'procesos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'ph_inicial',
        'ph_esperado',
        'cloro_inicial',
        'cloro_esperado',
        'ph_final',
        'cloro_final',
        'volumen_pro',
        'urlPH',
        'urlCL',

    ];
    protected $dates = [
        'fecha',
        'hora'
    ];


    public function calcularCantidadCloro()
    {
        $volumenLitros = $this->volumen_pro;
        $cloroInicial = $this->cloro_inicial;
        $cloroDeseado = $this->cloro_esperado;
        $cantidadPorLitro = 1.5; // gramos/1000 litros
        
        if($cloroInicial < $cloroDeseado){
            $cantidadCloroPorLitros = ($cantidadPorLitro / 1000) * $volumenLitros;  //42
            $diferenciaCloro = $cloroDeseado - $cloroInicial;
            $diferenciaCloroGramos = ($diferenciaCloro * $volumenLitros) / 1000;  //0
            $cantidadTotalCloro = $cantidadCloroPorLitros + $diferenciaCloroGramos;
    
            return "La cantidad de Cloro que se debe aumentar es: " .  $cantidadTotalCloro;
        }else{
            return "Debe espera 5hr de reposo sui su piscina esta co contacto directo al sol y 8 horas si esta bajo techo";
        }
    
    }


    public function calcularCantidadpH()
    {
        $volumenLitros = $this->volumen_pro;
        $pHInicial = $this->ph_inicial;
        $pHEsperado = $this->ph_esperado;
        $cantidadPorLitro = 1.5; // gramos/1000 litros
        $capacidadNeutralizacion = 0.15; // ml/L

        if ($pHInicial > $pHEsperado) {
            $diferenciaPH = $pHInicial - $pHEsperado;
            $cantidadAcidoClorhidrico = ($volumenLitros * $diferenciaPH) / $capacidadNeutralizacion;
            return  "El reductor de ph es:  ". $cantidadAcidoClorhidrico;
        } else {
            $diferenciaPH = $pHEsperado - $pHInicial;
            $diferenciaPHGramos = $diferenciaPH * $volumenLitros;
            $cantidadTotalPH = $cantidadPorLitro * $volumenLitros + $diferenciaPHGramos;
            return   "La cantidade de aumentador de ph es:". $cantidadTotalPH;
        }
    }
    /*     public function calcularCantidadCloro()
    {La cantidade de aumentador de ph es:
        $volumenLitros = $this->volumen_pro;
        $cloroInicial = $this->clo_inicial;
        $cloroDeseado = $this->clo_esperado;

        $cantidadCloroPorLitros = 1.5 * $volumenLitros / 1000;
        $diferenciaCloro =  -$cloroDeseado - $cloroInicial;
        $diferenciaCloroGramos = ($diferenciaCloro * $volumenLitros) / 1000;

        $cantidadTotalCloro = $cantidadCloroPorLitros + $diferenciaCloroGramos;

        return $cantidadTotalCloro;
    }



    public function calcularCantidadAcidoClorhidrico()
    {
        $volumenLitros = $this->volumen_pro;
        $phInicial = $this->ph_inicial;
        $phEsperado = $this->ph_esperado;
        $capacidadNeutralizacion = 0.15; // ml/L

        $diferenciaPH = $phEsperado - $phInicial;
        $cantidadAcidoClorhidrico = ($volumenLitros * $diferenciaPH) / $capacidadNeutralizacion;

        return $cantidadAcidoClorhidrico;
    }
 */
    /*  public function calcularCantidadCloro($cloroInicial, $cloroFinal, $cloroEsperado)
    {
        $diferenciaCloro = $cloroFinal - $cloroInicial;

        if ($diferenciaCloro > 0) {
            // Reductor de cloro
            $cantidadCloro = $cloroEsperado - $cloroFinal;
            $accion = 'Agregar reductor de cloro';
        } else {
            // Aumentador de cloro
            $cantidadCloro = $cloroFinal - $cloroEsperado;
            $accion = 'Agregar aumentador de cloro';
        }

        return [
            'cantidadCloro' => $cantidadCloro,
            'accion' => $accion,
        ];
    } */

    /* public function calcularCantidadPH($phInicial, $phFinal, $phEsperado)
    {
        $diferenciaPH = $phFinal - $phInicial;

        if ($diferenciaPH > 0) {
            // Reductor de pH
            $cantidadPH = $phEsperado - $phFinal;
            $accion = 'Agregar reductor de pH';
        } else {
            // Aumentador de pH
            $cantidadPH = $phFinal - $phEsperado;
            $accion = 'Agregar aumentador de pH';
        }

        return [
            'cantidadPH' => $cantidadPH,
            'accion' => $accion,
        ];
    } */
}
