<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    if ($request->hasFile('fotosucursal')) {
      $file = $request->file('fotosucursal');
      $fileName = time() . '_' . $file->getClientOriginalName();
      $directory = 'sucursal' ;

      Storage::disk('s3')->putFileAs($directory, $file, $fileName, 'public');
      $fileUrl = Storage::disk('s3')->url($directory . '/' . $fileName);

      $sucursal->foto = $fileUrl;
  }
    //$sucursal->imagen = $request->archivosucursal;
    // $sucursal->organizadorId = Auth::user()->id;
    $sucursal->save();

    return redirect()->route('sucursales.index');
  }

  public function show(Sucursal $sucursal)
  {
    return view('sucursales.show', compact('sucursal'));
  }

  public function edit($id)
  {
    $sucursal = Sucursal::find($id);
    return view('sucursales.edit', compact('sucursal'));
  }

  public function update(Request $request, Sucursal $id)
  {
  /*  $sucursal = Sucursal::find($id);
    $sucursal->nombre = $request->nombresucursal;
    $sucursal->descripcion = $request->descripcionsucursal;
    $sucursal->telefono = $request->telefonosucursal;
    $sucursal->direccion = $request->direccionsucursal;
    $sucursal->save(); */

    $id->nombre = $request->nombresucursal;
    $id->descripcion = $request->descripcionsucursal;
    $id->telefono = $request->telefonosucursal;
    $id->direccion = $request->direccionsucursal;
    $id->save();

    return redirect()->route('sucursales.index');

  }



  public function destroy(Sucursal $sucursal)
  {
    $sucursal->delete();
    return redirect()->route('sucursales.index');
  }
}
