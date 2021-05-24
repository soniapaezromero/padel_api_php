<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Carbon\Carbon;

class ReservasController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $end = $now->addDays(7);
        $reservasall = Reserva::get();
        $reservas = auth()->user()->reservas();

        return view('dashboard', compact('reservas', 'now', 'end'));
    }

    public function add()
    {
        $now = Carbon::now();
        $end = $now->addDays(7);
        $startmin = Carbon::createFromTime(9, 00);
        $startmax = Carbon::createFromTime(22, 00);
        $endmin = Carbon::createFromTime(10, 00);
        $endmax = Carbon::createFromTime(22, 00);
        return view('add', compact('now', 'end', 'startmin', 'startmax', 'endmin', 'endmax'));

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'email_cia' => 'required'
        ]);
        $fechaReservas = Carbon::parse($request->fecha);
        $fechaReservas=$fechaReservas->format('d-m-Y');
        $horaReservas = $request->hora_comienzo;
        $cogidas = Reserva:: where('fecha', $fechaReservas)->where('hora_comienzo', $horaReservas);
        $reserva = new Reserva();
        $reserva->fecha = $fechaReservas;
        $reserva->hora_comienzo = $request->hora_comienzo;
        $reserva->hora_fin = $request->hora_fin;
        $reserva->email_company = $request->email_cia;
        $reserva->user_id = auth()->user()->id;
        $reserva->save();
        return redirect('/dashboard');

    }

    public function edit(Reserva $reserva)
    {

        if (auth()->user()->id == $reserva->user_id) {
            $fecharecibida =  $reserva->fecha;
            $fechaBase = Carbon::parse($fecharecibida);
            $fechaformateada = $fechaBase->format('d-m-Y');
            $now = Carbon::now();
            $end = $now->addDays(7);
            $startmin = Carbon::createFromTime(9, 00);
            $startmax = Carbon::createFromTime(22, 00);
            $endmin = Carbon::createFromTime(10, 00);
            $endmax = Carbon::createFromTime(22, 00);
            return view('edit', compact('reserva', 'fechaformateada', 'now', 'end', 'startmin', 'startmax', 'endmin', 'endmax'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Reserva $reserva)
    {
        if (isset($_POST['delete'])) {
            $reserva->delete();
            return redirect('/dashboard');
        } else {
            $this->validate($request, [
                'email_cia' => 'required'
            ]);
            $fechaReservas = Carbon::parse($request->fecha);
            $fechaReservas=$fechaReservas->format('d-m-Y');
            $reserva->fecha = $fechaReservas;
            $reserva->hora_comienzo = $request->hora_comienzo;
            $reserva->hora_fin = $request->hora_fin;
            $reserva->email_company = $request->email_cia;
            $reserva->user_id = auth()->user()->id;
            $reserva->save();
            return redirect('/dashboard');
        }
    }

    public function search(Request $request)
    {

        $now = Carbon::now();
        $end = $now->addDays(7);
        $reservas = Reserva::get();
        $fecha=$request->fechabusqueda;
        return view('search', compact('reservas','now','end'));

    }

    public function busqueda(Request $request)
    {
        $now = Carbon::now();
        $end = $now->addDays(7);
        $fecha=$request->fechabusqueda;
        $fechaString=Carbon::parse($fecha);
        $fechaString=$fechaString->format('d-m-Y');
        $reservas= Reserva::where('fecha','=',$fechaString)->get();
        return view('search', compact('reservas','now','end','fechaString'));
    }

}


