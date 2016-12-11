@extends('layouts.layout')

@section('top')
        <h2>Dashboard</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Sistema</span></li>
                <li><span>Inicio</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
@endsection
@section('content')
        <div class="col-md-12">
            @foreach($dashboard as $horario)
            <div class="row">
                <div class="col-sm-3">
                    <section class="panel">
                        <div class="panel-body bg-primary">
                            <div class="widget-summary">
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">{{$horario['dsc_disponiveis']}}</h4>
                                        <div class="info">
                                            <strong class="amount">{{$dia}}1: {{$horario['qtd_disponiveis1']}}</strong>
                                        </div>
                                        <div class="info">
                                            <strong class="amount">{{$dia}}2: {{$horario['qtd_disponiveis2']}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            <div class="col-sm-3">
                <section class="panel">
                    <div class="panel-body bg-tertiary">
                        <div class="widget-summary">
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">{{$horario['dsc_reservadas']}}</h4>
                                    <div class="info">
                                        <strong class="amount">{{$dia}}1: {{$horario['qtd_reservadas1']}}</strong>
                                    </div>
                                    <div class="info">
                                        <strong class="amount">{{$dia}}2: {{$horario['qtd_reservadas2']}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @endforeach
    </div>
@stop