<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       // Crear la reserva
    $reserva = new Reserva();
    $reserva->nombre = $request->nombrereserva;
    $reserva->descripcion = $request->descripcionreserva;
    $reserva->precio = $request->precioreserva;
    $reserva->fecha = $request->fechareserva;

    // Combine date and time to create a valid datetime value for hora_inicio
    $reserva->hora_inicio = $request->fechareserva . ' ' . $request->horainireserva;

    // Combine date and time to create a valid datetime value for hora_final
    $reserva->hora_final = $request->fechareserva . ' ' . $request->horafinreserva;

    $reserva->ambiente_id = $request->input('ambiente_id');
    $reserva->user_id = $request->input('user_id');
    $reserva->save();

    // Actualizar el estado del ambiente a ocupado
    $ambiente = Ambiente::find($request->input('ambiente_id'));
    $ambiente->estado = 'ocupado'; // Change 'ocupado' to the appropriate value if needed
    $ambiente->save();

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
       
       // Store the ambiente ID before deleting the reservation
    $ambienteId = $reserva->ambiente_id;

    // Delete the reserva
    $reserva->delete();

    // Update the estado of the ambiente to 'disponible'
    $ambiente = Ambiente::find($ambienteId);
    $ambiente->estado = 'disponible'; // Change 'disponible' to the appropriate value if needed
    $ambiente->save();

    return redirect()->route('reservas.index')->with('success', 'Reserva eliminada exitosamente.');
    }

    public function mireserva()
    {
        $reservas = Reserva::all();
        $users = User::all();
        $ambientes = Ambiente::all();
        return view('reservas.mireserva', compact('reservas', 'users', 'ambientes'));

    }
}
