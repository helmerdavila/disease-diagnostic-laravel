@extends('layouts.layoutadmin')
@section('title') Enfermedades @stop
@section('breadcrumb') Enfermedades @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Editar Enfermedad {{ $enfermedad->name }}</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('nombre', $enfermedad->name, ['autocomplete' => 'off']) !!}
                    {!! Field::text('nombre_c', $enfermedad->name_c, ['label' => 'Nombre Científico', 'autocomplete' => 'off']) !!}
                    {!! Field::select('sintomas', $sintomas, ['8', '18'], ['multiple', 'class' => '', 'label' => 'Síntomas', 'empty' => false]) !!}
                    {!! Form::submit('Actualizar', ['class' => 'btn btn-warning']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
