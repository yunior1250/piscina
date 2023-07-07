<?php

namespace App\Http\Controllers;

use App\Models\Piscina;
use App\Models\Proceso;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    public function index()
    {
        $procesos = Proceso::all();
        $piscinas = Piscina::all();

        return view('procesos.index', compact('procesos', 'piscinas'));
    }

    public function create()
    {
        $piscinas = Piscina::all();
        //    $users = User::all();
        return view('procesos.create', compact('piscinas'));
    }

    public function store(Request $request)
    {
        $proceso = new Proceso();
        $proceso->nombre = $request->nombreproceso;
        $proceso->descripcion = $request->descripcionproceso;
        $proceso->ph_inicial = $request->ph_inicial;
        $proceso->ph_esperado = $request->ph_esperado;
        $proceso->cloro_inicial = $request->cloro_inicial;
        $proceso->cloro_esperado = $request->cloro_esperado;
        $proceso->cloro_final = $request->cloro_final;
        $proceso->ph_final = $request->ph_final;
        $proceso->voljmen_pro = $request->volumen_pro;


        $proceso->fecha_fin = $request->fechafinreserva;
        // $ambiente->imagen = $request->archivoambiente;
        //   $ambiente->organizadorId = Auth::user()->id;
        if ($request->hasFile('archivoambiente')) {
            $imagen = $request->file('archivoambiente');
            $rutaImagen = $imagen->store('public/imagenes'); // Cambia la ruta según tus necesidades
            $proceso->imagen = $rutaImagen;
        }
        //$sucursal = Sucursal::findOrFail($request->sucursal);
        $proceso->piscina_id = $request->input('piscina_id');
        +$proceso->save();

        return redirect()->route('procesos.index');
    }

    public function show(Proceso $reserva)
    {
        return view('procesos.show', compact('proceso'));
    }

    public function edit(Proceso $reserva)
    {
        return view('procesos.edit', compact('proceso'));
    }

    public function update(Request $request, Proceso $reserva)
    {
        $reserva->update($request->all());
        return redirect()->route('procesos.index');
    }

    public function destroy(Proceso $reserva)
    {
        $reserva->delete();
        return redirect()->route('procesos.index');
    }
}
