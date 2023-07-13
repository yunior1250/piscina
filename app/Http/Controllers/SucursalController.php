<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
      $sucursales = Sucursal::all();
        return view('sucursales.index', compact('sucursales'));
    }
    public function create()
    {
        return view('sucursales.create');
    }
    public function store(Request $request)
    {
      $sucursal = new Sucursal();
      $sucursal->nombre = $request->nombresucursal;
      $sucursal->descripcion = $request->descripcionsucursal;
      $sucursal->telefono = $request->telefonosucursal;
      $sucursal->direccion = $request->direccionsucursal;
      //$sucursal->imagen = $request->archivosucursal;
     // $sucursal->organizadorId = Auth::user()->id;
      $sucursal->save();

        return redirect()->route('sucursales.index');
    }

    public function show(Sucursal $sucursal)
    {
        return view('sucursales.show', compact('sucursal'));
    }

    public function edit(Sucursal $sucursal)
    {
        return view('sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, Sucursal $sucursal)
    {
      $sucursal->update($request->all());
        return redirect()->route('sucursales.index');
    }
    public function destroy(Sucursal $sucursal)
    {
      $sucursal->delete();
        return redirect()->route('sucursales.index');
    }
}
