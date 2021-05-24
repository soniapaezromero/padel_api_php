<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Reserva;
use App\Http\Resources\Reserva as ReservaResource;

class ReservaController extends BaseController
{

    public function index()
    {
        $reserva = Reserva::where('user_id', auth()->user()->id)
            ->get();
        return $this->sendResponse(ReservaResource::collection($reserva), 'Reservas fetched.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email_company' => 'required'
        ]);

        if ($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $reserva = new reserva();
        $reserva->fecha = $request->fecha;
        $reserva->hora_comienzo = $request->hora_comienzo;
        $reserva->hora_fin = $request->hora_fin;
        $reserva->email_company = $request->email_company;
        $reserva->user_id = auth()->user()->id;
        $reserva->save();

        return $this->sendResponse(new ReservaResource($reserva), 'Reservas created.');
    }


    public function show($id)
    {
        $reserva = Reserva::find($id);

        if (is_null($reserva)) {
            return $this->sendError('Reserva does not exist.');
        }
        return $this->sendResponse(new ReservaResource($reserva), 'Reserva fetched.');
    }


    public function update(Request $request, Reserva $reserva)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email_company' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $reserva->fecha = $input['fecha'];
        $reserva->hora_comienzo = $input['hora_comienzo'];
        $reserva->hora_fin = $input['hora_fin'];
        $reserva->email_company = $input['email_company'];
        $reserva->save();

        return $this->sendResponse(new ReservaResource($reserva), 'Reserva updated.');
    }

    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        if (is_null($reserva)) {
            return $this->sendError('Reserva does not exist.', 'Reserva NOT deleted.');
        }
        else {
            $reserva->delete();
            return $this->sendResponse([], 'Reserva deleted.');
        }
    }
}
