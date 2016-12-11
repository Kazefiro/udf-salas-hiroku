@extends('layouts.layout')
@section('top')
    <h2>ENSALAMENTO TARDE</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Inicio</span></li>
            <li><span>Sala</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel">
                <a class="mb-xs mt-xs mr-xs btn btn-primary pull-right" type="button" href="{{'/ensalamento/gerar'}}">GERAR ENSALAMENTO</a>
            </div>
            <h2 class="panel-title">VESPERTINO</h2>
            @include('alert')
        </header>

        <div class="panel-body">
            <table class="table table-striped" id="datatable-default">
                <thead>
                <tr>
                    <th>CODIGO</th>
                    <th>DISCIPLINA</th>
                    <th>HORARIO</th>
                    <th>PERIODO</th>
                    <th>QTD MAT</th>
                    <th>PROFESSOR</th>
                    <th>SALA</th>
                    <th>CAPACIDADE</th>
                    <th>CAMPUS</th>
                    <th>AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vespertino as $tarde)
                    <tr class="gradeX">
                        <td>{{$tarde->nom_oferta}}</td>
                        <td>{{$tarde->nom_disciplina}}</td>
                        <td>{{$tarde->nom_horario}}</td>
                        <td>{{$tarde->nom_periodo}}</td>
                        <td>{{$tarde->total_matriculados}}</td>
                        <td>{{$tarde->nom_professor}}</td>
                        <td>{{$tarde->nom_sala}}</td>
                        <td>{{$tarde->qtd_assentos}}</td>
                        <td>{{$tarde->nom_campus}}</td>
                        <td>
                            <a class="glyphicon glyphicon-search"   href="/ensalamento/show/{{$tarde->nom_oferta}}"></a>
                            <a class="glyphicon glyphicon-edit"   href="/oferta/edit/{{$tarde->nom_oferta}}"></a>
                            <a class="glyphicon glyphicon-trash"    href="/oferta/delete/{{$tarde->nom_oferta}}"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop



