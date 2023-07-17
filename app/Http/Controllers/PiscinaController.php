<?php

namespace App\Http\Controllers;

use App\Models\Piscina;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class PiscinaController extends Controller
{
    public function index()
    {
        $piscinas = Piscina::all();
        return view('piscinas.index', compact('piscinas'));
    }
    public function create()
    {
        $sucursales = Sucursal::all();
        return view('piscinas.create',compact('sucursales'));
    }
    public function store(Request $request)
    {
        $piscina = new Piscina();
        $piscina->nombre = $request->nombrepisicna;
        $piscina->descripcion = $request->descripcionpisicna;
        $piscina->tipo = $request->tipopiscina;
        $piscina->largo = $request->largopiscina;
        $piscina->ancho = $request->anchopiscina;
        $piscina->profundidad = $request->profundidadpiscina;
        $piscina->radio = $request->radiopiscina;

        // Calcular volumen
        $volumen = $piscina->calcularVolumen();
        $piscina->volumen = $volumen;
        $piscina->sucursal_id = $request->input('sucursal_id');
        $piscina->save();

        return redirect()->route('piscinas.index')->with('success', 'Piscina creada exitosamente. Volumen: ' . $volumen);
    }

    public function show(Piscina $piscina)
    {
        return view('piscinas.show', compact('piscina'));
    }

    public function edit(Piscina $piscina)
    {
        return view('piscinas.edit', compact('piscina'));
    }

    public function update(Request $request, Piscina $piscina)
    {
        $piscina->update($request->all());
        return redirect()->route('piscinas.index');
    }
    public function destroy(Piscina $piscina)
    {
        $piscina->delete();
        return redirect()->route('piscinas.index');
    }
}



