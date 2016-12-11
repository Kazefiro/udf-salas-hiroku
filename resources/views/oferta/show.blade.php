@extends('layouts.layout')
@section('top')
    <h2>VISUALIZAR OFERTA</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Oferta</span></li>
            <li><span>Show</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
<section class="panel">
    <div class="panel-body">
        <div class="invoice">
            <header class="clearfix">
                <div class="row">
                    <div class="col-sm-6 mt-md">
                        <h2 class="h2 mt-none mb-sm text-dark text-bold">OFERTA Nº {{$ofertas->nom_oferta}}</h2>
                        <h4 class="h5 m-none text-dark text-bold">{{$ofertas->nom_disciplina}}</h4>
                    </div>
                </div>
            </header>
            <div class="bill-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bill-to">
                            <p class="h5 mb-xs text-dark text-semibold">CURSO:</p>
                            <p>{{$ofertas->nom_curso}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">PROFESSOR:</p>
                            <p>{{$ofertas->nom_professor}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">CARGA HORÁRIA:</p>
                            <p>{{$ofertas->nom_horario}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">PERIODO:</p>
                            <p>{{$ofertas->nom_periodo}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">QUANTIDADE DE ASSENTOS:</p>
                            <p>{{$ofertas->qtd_assentos}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">SALA:</p>
                            <p>{{$ofertas->nom_sala}}</p>
                            <p class="h5 mb-xs text-dark text-semibold">CAMPUS:</p>
                            <p>{{$ofertas->campus_sala}}</p>

                        </div>
                    </div>
                </div>
            </div>
        <div class="text-right mr-lg">
            <a href="#" class="btn btn-default">Voltar</a>
            <a href="/oferta/edit/{{$ofertas->nom_oferta}}" class="btn btn-primary">Editar</a>
            <a href="/oferta/delete/{{$ofertas->nom_oferta}}" class="btn btn-danger">Delete</a>
        </div>
    </div>
    </div>
</section>

@stop