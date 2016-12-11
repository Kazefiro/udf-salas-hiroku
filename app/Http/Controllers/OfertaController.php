<?php

namespace UDF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use UDF\Oferta;
use UDF\Sala;


class OfertaController extends Controller
{

    public function index()
    {
        return view('oferta.index');
    }

    public function edit($nom_oferta)
    {
        $ofertas = Oferta::where('nom_oferta', $nom_oferta)->first();
        $sala_selects = Sala::all();
        $salas = [];
        foreach ($sala_selects as $sala){
            $salas[$sala->cod_sala] = $sala->nom_sala;
        }

        return view('oferta.edit',
            [
                'ofertas' => $ofertas,
                'sala_selects' => $salas
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nom_oferta)
    {
        $ofertas = Oferta::where('nom_oferta', $nom_oferta)->first();
        if (!$ofertas) {
            session()->flash('flash_message_delete', 'Oferta não existe!');
        } else {
            $ofertas->update($request->all());
            session()->flash('flash_message_edit', 'Atualizado com Sucesso!');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nom_oferta)
    {
        $ofertas = Oferta::where('nom_oferta', $nom_oferta)->first();
        $ofertas->delete();
        session()->flash('flash_message_del', 'Excluido com Sucesso!');

        return redirect()->back();
    }


    public function import()
    {

        $file = ['upload_file' => Input::file('upload_file')];
        if ($file) {
            $destino = '../storage/app/csv';
            $arquivo = Input::file('upload_file');
            $nomeArquivo = $arquivo->getClientOriginalName();
            $arquivo->move($destino, $nomeArquivo);

            $truncate = Oferta::truncate();

            if ($truncate) {
                Excel::load('storage/app/csv/' . $nomeArquivo, function ($reader) {
                    foreach ($reader->get() as $oferta) {
                        $codSala = null;
                        if ($oferta->sala && $oferta->campus) {
                            $objSala = Sala::select('cod_sala')->where('nom_sala', $oferta->sala)
                                ->where('campus_sala', $oferta->campus)->first();
                            if ($objSala)
                                $codSala = $objSala->cod_sala;
                        }
                        Oferta::create([
                            'nom_oferta' => $oferta->c_ofer,
                            'cod_disciplina' => $oferta->c_disc,
                            'nom_disciplina' => $oferta->disciplina,
                            'nom_curso' => $oferta->curso,
                            'nom_horario' => $oferta->oferta,
                            'nom_periodo' => $oferta->periodo,
                            'nom_professor' => $oferta->professor,
                            'cod_sala' => $codSala,
                            'nom_campus' => $oferta->campus,
                            'total_matriculados' => $oferta->t_mat,
                            'ser' => $oferta->ser,
                            'carga_horaria' => $oferta->ch
                        ]);
                    }
                });
            }
        }

        session()->flash('flash_message', 'Ofertas importadas com sucesso!');

        return redirect('/oferta');
    }
    
    public function export(){

        $ofertas = Oferta::select(
            DB::raw('nom_oferta as c_ofer'),
            DB::raw('nom_horario as oferta'),
            DB::raw('cod_disciplina as c_disc'),
            DB::raw('nom_disciplina as DISCIPLINA'),
            DB::raw('nom_curso as CURSO'),
            DB::raw('ser as SER'),
            DB::raw('carga_horaria as CH'),
            DB::raw('nom_periodo as período'),
            DB::raw('nom_campus as CAMPUS'),
            DB::raw('nom_sala as sala'),
            DB::raw('total_matriculados as t_mat'),
            DB::raw('nom_professor as professor')
        )->leftJoin('salas', 'ofertas.cod_sala', '=', 'salas.cod_sala')
            ->get();

        Excel::create('Ofertas_'.date('d_m_Y_H_i'), function($excel) use($ofertas) {

            $excel->sheet('Ofertas', function($sheet) use($ofertas) {

                $sheet->fromArray($ofertas);

            });

        })->export('xls');

        return redirect('/oferta');
    }

}