<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('fotoambiente')) {
            $file = $request->file('fotoambiente');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $directory = 'ambiente' ;
      
            Storage::disk('s3')->putFileAs($directory, $file, $fileName, 'public');
            $fileUrl = Storage::disk('s3')->url($directory . '/' . $fileName);
      
            $ambiente->foto = $fileUrl;
        }
        $ambiente->sucursal_id = $request->input('sucursal_id');
        $ambiente->save();

        return redirect()->route('ambientes.index');
    }

    public function show(Ambiente $ambiente)
    {
        return view('ambientes.show', compact('ambiente'));
    }

    public function edit( $id)
    {

        $sucursales = Sucursal::all();
        $ambiente = Ambiente::findOrFail($id);
        return view('ambientes.edit', compact('sucursales', 'ambiente'));
    }

    public function update(Request $request,  $id)
    {
        $ambiente =Ambiente::find($id) ;
        $ambiente->nombre = $request->nombreambiente;
        $ambiente->descripcion = $request->descripcionambiente;
        $ambiente->capacidad = $request->capacidadambiente;
        
      
        $ambiente->sucursal_id = $request->input('sucursal_id');


        $ambiente->save();

        return redirect()->route('ambientes.index');
    }

    public function destroy(Ambiente $ambiente)
    {
        $ambiente->delete();
        return redirect()->route('ambientes.index');
    }
}
