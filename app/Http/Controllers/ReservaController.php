<?php

namespace UDF\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use UDF\Reserva;
use UDF\Sala;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::orderBy('cod_reserva','desc')
            ->leftJoin('salas', 'reservas.cod_sala', '=', 'salas.cod_sala')->get();
        return view('reserva.index')->with(compact('reservas'));
    }

    public function create()
    {

        $sala_selects  = Sala::all(['cod_sala','nom_sala']);
        $salas = [];
        foreach ($sala_selects as $sala){

            $salas[$sala->cod_sala] = $sala->nom_sala;
        }

        return view('reserva.create',['sala_selects' => $salas]);
    }


    public function edit($id){

        $reservas = Reserva::findOrFail($id);
        $dataInicio = Carbon::parse($reservas['dat_inicio']) ;
        $datTermino = Carbon::parse($reservas['dat_termino']);
        $dat_inicio = $dataInicio->format('d/m/Y');
        $dat_termino= $datTermino->format('d/m/Y');

        $sala_selects = Sala::all();
        $salas = [];


        foreach ($sala_selects as $sala){

                $salas[$sala->cod_sala] = $sala->nom_sala;
        }
        return view('reserva.edit',
            [
            'reservas'=>$reservas,
            'sala_selects' => $salas,
            'dat_inicio' => $dat_inicio,
            'dat_termino' => $dat_termino
            ]);

    }

    public function store(Request $request)
    {
        $rules = [

                'obs_reserva' =>'required',
                'nom_horario' =>'required' ,
                'nom_periodo'=>'required' ,
                'dat_inicio'=>'required',
                'dat_termino'=>'required' ,
        ];

        $this->validate($request , $rules);

        Reserva::create($request->all());
        session()->flash('flash_message', 'Reserva realizada com Sucesso!');

        return redirect('/reserva ');
    }

    public function update(Request $request , $id)
    {

        $reserva = Reserva::findOrFail($id);
         $rules = [
            'obs_reserva' =>'required',
            'nom_horario' =>'required' ,
            'nom_periodo'=>'required' ,
            'dat_inicio'=>'required',
            'dat_termino'=>'required' ,
            'cod_sala'=>'required'
        ];
        $this->validate($request , $rules);
        $reserva->update($request->all());

        session()->flash('flash_message_edit', 'Atualizado com Sucesso!');

        return redirect('/reserva');
    }

    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();
        session()->flash('flash_message_del', 'Excluido com Sucesso!');

        return redirect('/reserva');
    }


}
