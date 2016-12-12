@extends('layouts.layout')
<meta name="csrf-token" content="{{ csrf_token() }}"/>
@section('top')
    <h2>RESERVAS</h2>
    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Reserva</span></li>
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
                    <h2 class="panel-title">Editar Reservas</h2>
                    @include('alert')
                </header>
                <div class="panel-body">
                    {!! Form::model($reservas, ['url' => '/reserva/update/'.$reservas->cod_reserva, 'method' => 'PUT', 'class'=>'form-horizontal form-bordered']) !!}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Data</label>
                        <div class="col-md-6">
                            <div class="input-daterange input-group" id="datepicker" data-plugin-datepicker>
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                {!! Form::text('dat_inicio',$dat_inicio, ['class'=>'form-control', 'onchange' => 'javascript:getSalas()']) !!}

                                <span class="input-group-addon">à</span>
                                {!! Form::text('dat_termino',$dat_termino,['class'=>'form-control', 'onchange' => 'javascript:getSalas()']) !!}

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Horário</label>
                        <div class="col-md-6">
                            <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </span>
                                {!! Form::text('nom_horario', null, ['class'=>'form-control', 'onchange' => 'javascript:getSalas()']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('data', 'Periodo',  [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::label('Manhã') !!}
                            {!! Form::radio('nom_periodo', 'Manhã', ['onchange' => 'javascript:getSalas()']) !!}
                            {!! Form::label('Tarde') !!}
                            {!! Form::radio('nom_periodo', 'Tarde', ['onchange' => 'javascript:getSalas()']) !!}
                            {!! Form::label('Noite') !!}
                            {!! Form::radio('nom_periodo', 'Noite', ['onchange' => 'javascript:getSalas()']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('reservas', 'Salas Disponíveis', [ 'class'=>'col-md-3 control-label']) !!}
                        <div class="col-md-6">
                            {{ Form::select('cod_sala', array('Selecione Data, Horário e Periodo...'), null, ['class' => 'form-control input-sm mb-md']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="obsreserva">Descrição da Reserva</label>
                        <div class="col-md-6">
                            {{ Form::textarea('obs_reserva', null, ['class' => 'form-control' , 'maxlength'=>140]) }}
                        </div>
                    </div>

                    <div class="box-footer">
                        {!! Form::submit('Atualizar', ['class' =>  'btn btn-primary']) !!}
                        <a class="btn btn-default pull-right" type="button" href="{{'/reserva'}}">Cancelar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            getSalas();
        });
        function getSalas() {
            var datini = $('[name=dat_inicio]').val();
            var datfim = $('[name=dat_termino]').val();
            var nomhor = $('[name=nom_horario]').val();
            var nomper = $('[name=nom_periodo]:checked').val();
            var codRes = '<?= $reservas->cod_reserva?>';

            if (nomhor.length >= 2 && datini != '' && datfim != '' && nomper != '') {
                $.ajax({
                    url: '/reserva/getSalas',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        nom_horario: nomhor,
                        dat_inicio: datini,
                        dat_termino: datfim,
                        nom_periodo: nomper,
                        cod_reserva: codRes
                    },
                    success: function (json) {
                        $("[name=cod_sala]")
                                .find('option')
                                .remove()
                                .end();
                        $.each(json, function () {
                            $("[name=cod_sala]")
                                    .append('<option value="' + this.cod_sala + '">' + this.nom_sala + '</option>')
                        });
                    }
                });
            }
        }

    </script>
@stop