@extends('layouts.layoutadmin')
@section('title') Síntomas @stop
@section('breadcrumb') Síntomas @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Editar Síntoma {{ $sintoma->name }}</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('name', $sintoma->name, ['placeholder' => 'Nombre del Síntoma', 'autocomplete' => 'off', 'autofocus' => '']) !!}
                    {!! Form::submit('Editar', ['class' => 'btn btn-warning']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
