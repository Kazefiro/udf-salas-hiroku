<?php

namespace UDF\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use UDF\Sala;

class SalaController extends Controller
{
    public function index()
    {
            $salas = Sala::get();
            return view('sala.index')->with(compact('salas'));
    }

    public function create()
    {
            return view('sala.create');
    }

    public function edit($id){

            $sala = Sala::findOrFail($id);

            return view('sala.edit',['sala'=> $sala]);

    }

    public function store(Request $request)
    {

            $rules = ['nom_sala'=>'required', 'qtd_assentos'=>'required'];
            $this->validate($request , $rules);


            $sala = Sala::create($request->all());
            $sala->save();

            session()->flash('flash_message', 'Cadastro Realizado com Sucesso!');

            return redirect('sala/create ');
    }

    public function update(Request $request , $id)
    {

            $rules = ['nom_sala'=>'required', 'qtd_assentos'=>'required'];
            $this->validate($request , $rules);


            $sala = Sala::findOrFail($id);
            $sala->update($request->all());

            session()->flash('flash_message_edit', 'Atualizado com Sucesso!');

            return redirect('/sala');
    }

    public function destroy($id)
    {
            $sala = Sala::find($id);
            $sala->delete();
            session()->flash('flash_message_del', 'Excluido com Sucesso!');

            return redirect('/sala');
    }

    public function import()
    {

        $file = ['upload_file' => Input::file('upload_file')];
        if ($file) {
            $destino = '../storage/app/csv';
            $arquivo = Input::file('upload_file');
            $nomeArquivo = $arquivo->getClientOriginalName();
            $arquivo->move($destino, $nomeArquivo);

            echo '<pre>';
            Sala::select('cod_sala')->delete();
            DB::statement("SELECT setval('udfsala.salas_cod_sala_seq', 1, true);");

            Excel::load('storage/app/csv/' . $nomeArquivo, function ($reader) {
                foreach ($reader->get() as $campus) {
                    $title = $campus->getTitle();
                    $nom_campus = 'SEDE';
                    if(strpos($title, '4R' )){
                        $nom_campus = '4R';
                    }
                    foreach ($campus as $sala) {
                        if ($sala->sala && $sala->carteiras) {
                            $objSala = Sala::select('cod_sala')->where('nom_sala', $sala->sala)
                                ->where('campus_sala', $nom_campus)->first();
                            if($objSala){
                                $objSala->update([
                                    'cod_sala' => $objSala->cod_sala,
                                    'nom_sala' => $sala->sala,
                                    'qtd_assentos' => $sala->carteiras,
                                    'qtd_max_assentos' => $sala->capacidade_maxima,
                                    'campus_sala' => $nom_campus
                                ]);
                            }else{
                                Sala::create([
                                    'nom_sala' => $sala->sala,
                                    'qtd_assentos' => $sala->carteiras,
                                    'qtd_max_assentos' => $sala->capacidade_maxima,
                                    'campus_sala' => $nom_campus
                                ]);
                            }
                        }
                    }
                }
            });
        }

        session()->flash('flash_message', 'Salas importadas com sucesso!');

        return redirect('/sala');


    }
}
