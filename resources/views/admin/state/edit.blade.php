@extends('layouts.layoutadmin')
@section('title') Estado @stop
@section('breadcrumb') Estado @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Editar Estado {{ $state->name }}</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('name', $state->name, ['label' => 'Nombre','placeholder' => 'Nombre del Síntoma', 'autocomplete' => 'off', 'autofocus' => '']) !!}
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-warning']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
