<div class="modal-wrapper">
    <div class="form-group">
        {!! Form::label('sala', 'Numero da Sala' , [ 'class'=>'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::Text('nom_sala', null, ['class' => 'form-control',  'placeholder'=>'Numero da Sala']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('assentos', 'Quantidade de Assentos', [ 'class'=>'col-md-3 control-label'] ) !!}
        <div class="col-md-6">
            {!! Form::Text('qtd_assentos', null, ['class' => 'form-control',  'placeholder'=>'Quantidade de Assentos']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('assentosMax', 'Quantidade Maxima de Assentos', [ 'class'=>'col-md-3 control-label'] ) !!}
        <div class="col-md-6">
            {!! Form::Text('qtd_max_assentos', null, ['class' => 'form-control',  'placeholder'=>'Quantidade Maxima de Assentos']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('campus', 'Campus', [ 'class'=>'col-md-3 control-label'] ) !!}
        <div class="col-md-6">
            {!! Form::Text('campus_sala', null, ['class' => 'form-control',  'placeholder'=>'Quantidade de Assentos']) !!}
        </div>
    </div>
</div>


