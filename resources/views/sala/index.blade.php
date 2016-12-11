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
            <li><span>Sala</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
    <section class="panel">
        <header class="panel-heading">
            <div class="panel">
                <a class="mb-xs mt-xs mr-xs btn btn-primary pull-right" type="button" href="{{'sala/create'}}">IMPORTAR SALAS</a>
            </div>
            <h2 class="panel-title">Informações das salas</h2>
            @include('alert')
        </header>

        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                <tr>
                    {{--<th>CODIGO</th>--}}
                    <th>NUMERO DA SALA</th>
                    <th>QUANTIDADE DE ASSENTOS</th>
                    <th>MAXIMOS DE ASSENTOS</th>
                    <th>CAMPUS</th>
                    <th>AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($salas as $sala)
                    <tr class="gradeX">
                        {{--<td>{{$sala->cod_sala}}</td>--}}
                        <td>{{$sala->nom_sala}}</td>
                        <td>{{$sala->qtd_assentos}}</td>
                        <td>{{$sala->qtd_max_assentos}}</td>
                        <td>{{$sala->campus_sala}}</td>
                        <td>
                            <a type="button" class="btn btn-success btn-sm "   href="/sala/edit/{{$sala->cod_sala}}">Editar</a>
                            <a type="button" class="btn btn-danger btn-sm "  href="/sala/delete/{{$sala->cod_sala}}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@stop



