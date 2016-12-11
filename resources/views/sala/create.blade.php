@extends('layouts.layout')
@section('top')
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Sala</span></li>
            <li><span>Carga</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">CARGA DE SALAS</h2>
                    @include('alert')
                </header>
                <div class="panel-body">
                    {!! Form::open(['url' => 'sala/import','files'=>true, 'method' => 'post', 'class'=>'form-horizontal form-bordered']) !!}
                    <div class="form-group center">
                        <label class="col-md-3 control-label center">Arquivo para Upload</label>
                        <div class="col-md-6">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <span class="fileupload-preview"></span>
                                    </div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-exists">Substituir</span>
                                            <span class="fileupload-new">Selecione o Arquivo</span>
                                            {!! Form::file('upload_file') !!}
                                        </span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Delete</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-primary " type="submit">Enviar</button>
                        <a class="btn btn-default pull-right" type="button" href="/sala">Cancelar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@stop