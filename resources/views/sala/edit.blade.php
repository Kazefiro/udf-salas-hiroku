@extends('layouts.layout')
@section('top')
    <h2>SALAS</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Sala</span></li>
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
                    <h2 class="panel-title">Editar Sala</h2>
                    @include('alert')
                </header>
                <div class="panel-body">
                    {!! Form::model($sala, ['url' => '/sala/update/'.$sala->cod_sala, 'method' => 'PUT', 'class'=>'form-horizontal form-bordered']) !!}
                    @include('sala.form')
                    <div class="box-footer">
                        {!! Form::submit('Atualizar', ['class' =>  'btn btn-primary']) !!}
                        <a class="btn btn-default pull-right" type="button" href="{{'/sala'}}" >Cancelar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@stop