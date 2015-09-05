@extends('layouts.layoutadmin')
@section('title')
    Enfermedades
@stop
@section('breadcrumb')
    Enfermedades
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nueva Enfermedad</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('nombre', null, ['autocomplete' => 'off']) !!}
                    {!! Field::text('nombre_c', null, ['label' => 'Nombre Científico', 'autocomplete' => 'off']) !!}
                    {!! Field::select('sintomas[]', $sintomas, null, ['multiple'=> '', 'class' => 'select2', 'label' => 'Síntomas', 'empty' => 'Seleccione un elemento']) !!}
                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Listado de Enfermedades</strong></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre Científico</th>
                            <th>Síntomas</th>
                            <th>Agregado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enfermedades as $enfermedad)
                            <tr>
                                <td>{{ $enfermedad->name }}</td>
                                <td>{{ $enfermedad->name_c }}</td>
                                <td>
                                    @foreach ($enfermedad->rules as $regla)
                                        <span class="label label-primary">{{ $regla->symptom->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $enfermedad->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
