@extends('layouts.layout')
@section('top')
    <h2>OFERTAS -  ENSAMENTO</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Oferta</span></li>
            <li><span>Editar</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Editar Ofertas</h2>
                    @include('alert')
                </header>
                <div class="panel-body">
                    {!! Form::model($ofertas, ['url' => '/oferta/update/'.$ofertas->nom_oferta , 'method' => 'PUT', 'class'=>'form-horizontal form-bordered']) !!}
                    <div class="form-group">
                        {!! Form::label('oferta', 'Oferta', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_oferta',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('disc', 'Codigo da Disciplina', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('cod_disciplina',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('nodisc', 'Nome da Discplina', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_disciplina',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('curso', 'Curso', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_curso',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('horario', 'Horario', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </span>
                            {!! Form::text('nom_horario', null, ['class'=>'form-control']) !!}
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('reservas', 'Numero Sala', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::select('cod_sala', $sala_selects, null, ['class' => 'form-control input-sm mb-md']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('data', 'Periodo',  [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_periodo', null , ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('prof', 'Professor', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_professor',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('campus', 'Campus', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('nom_campus',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('totalMatr', 'Total Matriculados', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('total_matriculados',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('ch', 'Carga Horaria', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('carga_horaria',  null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Atualizar', ['class' =>  'btn btn-primary']) !!}
                        <a class="btn btn-default pull-right" type="button" href="{{ redirect()->back() }}" >Cancelar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@stop