<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();
        $users = User::all();
        $ambientes = Ambiente::all();
        return view('reservas.index', compact('reservas', 'users', 'ambientes'));
    }

    public function create()
    {
        $ambientes = Ambiente::all();
        $users = User::all();
        return view('reservas.create', compact('ambientes', 'users'));
    }

    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->nombre = $request->nombrereserva;
        $reserva->descripcion = $request->descripcionreserva;
        $reserva->precio = $request->precioreserva;
        $reserva->fecha_ini = $request->fechainireserva;
        $reserva->fecha_fin = $request->fechafinreserva;
        // $ambiente->imagen = $request->archivoambiente;
        //   $ambiente->organizadorId = Auth::user()->id;
        if ($request->hasFile('archivoambiente')) {
            $imagen = $request->file('archivoambiente');
            $rutaImagen = $imagen->store('public/imagenes'); // Cambia la ruta según tus necesidades
            $reserva->imagen = $rutaImagen;
        }
        //$sucursal = Sucursal::findOrFail($request->sucursal);
        $reserva->ambiente_id = $request->input('ambiente_id');
        $reserva->user_id = $request->input('user_id');
        $reserva->save();

        return redirect()->route('reservas.index');
    }

    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    public function edit( $id)
    {
        $ambientes = Ambiente::all();
        $users = User::all();
        $reserva = Reserva::findOrFail($id);
        return view('reservas.edit', compact('ambientes', 'users', 'reserva'));
    }

    public function update(Request $request,  $id)
    {
        $reserva = Reserva::find($id);
        $reserva->nombre = $request->nombrereserva;
        $reserva->descripcion = $request->descripcionreserva;
        $reserva->precio = $request->precioreserva;
        $reserva->fecha_ini = $request->fechainireserva;
        $reserva->fecha_fin = $request->fechafinreserva;
        $reserva->ambiente_id = $request->input('ambiente_id');
        $reserva->user_id = $request->input('user_id');
        $reserva->save();

        return redirect()->route('reservas.index');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index');
    }
}
