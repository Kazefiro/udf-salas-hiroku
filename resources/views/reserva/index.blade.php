@extends('layouts.layout')
@section('top')
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Inicio</span></li>
            <li><span>Reservas</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel">
                <a class="mb-xs mt-xs mr-xs btn btn-primary pull-right" type="button" href="{{'reserva/create'}}">NOVA RESERVA</a>
            </div>
            <h2 class="panel-title">Informações das Reservas</h2>
            @include('alert')
        </header>

        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                <tr>
                    <th>CODIGO</th>
                    <th>Nº SALA</th>
                    <th>HORÁRIO</th>
                    <th>PERIODO</th>
                    <th>CAMPUS</th>
                    <th>INICIO</th>
                    <th>FIM</th>
                    <th>AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reservas as $reserva)
                    <tr class="gradeX">
                        <td>{{$reserva->cod_reserva}}</td>
                        <td>{{$reserva->nom_sala}}</td>
                        <td>{{$reserva->nom_horario}}</td>
                        <td>{{$reserva->nom_periodo}}</td>
                        <td>{{$reserva->campus_sala}}</td>
                        <td>{{$reserva->dsc_dat_inicio}}</td>
                        <td>{{$reserva->dsc_dat_termino}}</td>
                        <td>
                            <a type="button" class="btn btn-success btn-sm "   href="/reserva/edit/{{$reserva->cod_reserva}}">Editar</a>
                            <a type="button" class="btn btn-danger btn-sm "  href="/reserva/delete/{{$reserva->cod_reserva}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop



