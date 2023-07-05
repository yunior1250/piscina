<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbienteController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        $ambientes = Ambiente::all();
        return view('ambientes.index', compact('ambientes'));
    }

    public function create()
    {
        $sucursales = Sucursal::all();
        return view('ambientes.create', compact('sucursales'));
    }

    public function store(Request $request)
    {
        $ambiente = new Ambiente();
        $ambiente->nombre = $request->nombreambiente;
        $ambiente->descripcion = $request->descripcionambiente;
        $ambiente->capacidad = $request->capacidadambiente;
        // $ambiente->imagen = $request->archivoambiente;
        //   $ambiente->organizadorId = Auth::user()->id;
        if ($request->hasFile('archivoambiente')) {
            $imagen = $request->file('archivoambiente');
            $rutaImagen = $imagen->store('public/imagenes'); // Cambia la ruta según tus necesidades
            $ambiente->imagen = $rutaImagen;
        }
        //$sucursal = Sucursal::findOrFail($request->sucursal);
        $ambiente->sucursal_id = $request->input('sucursal_id');
        $ambiente->save();

        return redirect()->route('ambientes.index');
    }

    public function show(Ambiente $ambiente)
    {
        return view('ambientes.show', compact('ambiente'));
    }

    public function edit(Ambiente $ambiente)
    {
        return view('ambientes.edit', compact('ambiente'));
    }

    public function update(Request $request, Ambiente $ambiente)
    {
        $ambiente->update($request->all());
        return redirect()->route('ambientes.index');
    }

    public function destroy(Ambiente $ambiente)
    {
        $ambiente->delete();
        return redirect()->route('ambientes.index');
    }
}
