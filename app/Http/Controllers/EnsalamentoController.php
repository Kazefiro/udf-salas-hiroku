<?php

namespace UDF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use UDF\Oferta;
use UDF\Sala;

class EnsalamentoController extends Controller
{

    public function matutino()
    {

        $matutino = Oferta::select(
            'nom_oferta',
            'nom_disciplina',
            'nom_horario',
            'nom_periodo',
            DB::raw('sum(total_matriculados) as total_matriculados'),
            'nom_professor',
            'nom_sala',
            'qtd_assentos',
            'nom_campus'
        )->groupBy('nom_oferta', 'nom_disciplina', 'nom_horario', 'nom_periodo', 'nom_professor', 'salas.cod_sala', 'nom_campus')
            ->where('nom_periodo', 'MANHÃ')
            ->leftJoin('salas', 'ofertas.cod_sala', '=', 'salas.cod_sala')->get();
        return view('ensalamento.matutino')->with(compact('matutino'));

    }

    public function vespertino()
    {
        $vespertino = Oferta::select(
            'nom_oferta',
            'nom_disciplina',
            'nom_horario',
            'nom_periodo',
            DB::raw('sum(total_matriculados) as total_matriculados'),
            'nom_professor',
            'nom_sala',
            'qtd_assentos',
            'nom_campus'
        )->groupBy('nom_oferta', 'nom_disciplina', 'nom_horario', 'nom_periodo', 'nom_professor', 'salas.cod_sala', 'nom_campus')
            ->where('nom_periodo', 'TARDE')
            ->leftJoin('salas', 'ofertas.cod_sala', '=', 'salas.cod_sala')->get();
        return view('ensalamento.vespertino')->with(compact('vespertino'));
    }

    public function noturno()
    {

        $noturno = Oferta::select(
            'nom_oferta',
            'nom_disciplina',
            'nom_horario',
            'nom_periodo',
            DB::raw('sum(total_matriculados) as total_matriculados'),
            'nom_professor',
            'nom_sala',
            'qtd_assentos',
            'nom_campus'
        )->groupBy('nom_oferta', 'nom_disciplina', 'nom_horario', 'nom_periodo', 'nom_professor', 'salas.cod_sala', 'nom_campus')
            ->where('nom_periodo', 'NOITE')
            ->leftJoin('salas', 'ofertas.cod_sala', '=', 'salas.cod_sala')->get();
        return view('ensalamento.noturno')->with(compact('noturno'));
    }


    public function mostrarOferta($nom_oferta)
    {
        $ofertas = Oferta::where('nom_oferta', $nom_oferta)
            ->leftJoin('salas', 'ofertas.cod_sala', '=', 'salas.cod_sala')->first();
        return view('oferta.show', ['ofertas' => $ofertas]);
    }


//    Metodo para gerar ensalamento
    public function gerarEnsalamento()
    {
        $salas = Sala::where('qtd_assentos', '<>', null)->get();
        $ofertas = Oferta::select(
            'nom_oferta',
            'nom_horario',
            'nom_periodo',
            'nom_professor',
            'nom_campus',
            DB::raw('sum(total_matriculados) as alunos')
        )
            ->whereNotNull('nom_oferta')
            ->whereNotNull('cod_disciplina')
            ->whereNotNull('nom_horario')
            ->whereNotNull('nom_periodo')
            ->whereNotNull('nom_professor')
            ->whereNotNull('nom_campus')
            ->whereNotNull('total_matriculados')
            ->where('nom_horario', 'NOT ILIKE', '%X%')
            ->where('nom_horario', 'NOT ILIKE', '%B%')
            ->where('cod_sala')//is null
            ->groupBy('nom_oferta', 'nom_horario', 'nom_periodo', 'nom_professor', 'nom_campus')
            ->orderBy('alunos', 'desc')
            ->orderBy('nom_oferta')
            ->orderBy('nom_professor')
            ->get();

        if (count($salas) > 0 && count($ofertas) > 0) {
            foreach ($ofertas as $oferta) {
                $strHorario = $oferta['nom_horario'];
                if (strlen($oferta['nom_horario']) > 2 && strlen($oferta['nom_horario']) % 2 == 0) {
                    $strHorario = implode("|", str_split($oferta['nom_horario'], 2));
                }
                //var_dump($strHorario);
                $sala = Sala::select(DB::raw('coalesce(qtd_max_assentos, qtd_assentos) as capacidade'), 'cod_sala')
                    ->whereRaw("(qtd_max_assentos > {$oferta['alunos']} OR qtd_assentos > {$oferta['alunos']})")
                    ->whereRaw("cod_sala not in (select cod_sala from ofertas
                                where nom_horario similar to '%({$strHorario})%'
                                and nom_periodo = '{$oferta['nom_periodo']}'
                                and nom_campus = '{$oferta['nom_campus']}'
                                and cod_sala is not null)"
                    )->where('campus_sala', '=', $oferta['nom_campus'])
                    ->where('nom_sala', 'NOT ILIKE', '%LAB%')
                    ->groupBy('cod_sala')
                    ->orderBy('capacidade')
                    ->orderBy('nom_sala')
                    ->first();

                if ($sala['cod_sala']) {
                    Oferta::where('nom_oferta', $oferta['nom_oferta'])
                        ->update(['cod_sala' => $sala['cod_sala']]);
                }
            }
        }
        return redirect('/');
    }
}
