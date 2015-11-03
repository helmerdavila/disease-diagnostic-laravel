@extends('layouts.layoutadmin')
@section('title') Síntomas @stop
@section('breadcrumb') Síntomas @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nuevo Síntoma</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('name', null, ['ph' => 'Nombre del Síntoma', 'autocomplete' => 'off', 'autofocus' => '', 'label' => 'Nombre']) !!}
                    {!! Field::text('description', null, ['ph' => 'Una breve descripcion del síntoma', 'autocomplete' => 'off', 'label' => 'Descripción']) !!}
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
                <h3 class="box-title"><strong>Listado de Síntomas</strong></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th><i class="fa fa-gear"></i></th>
                        <th>Nombre</th>
                        <th>Agregado</th>
                        <th class="text-center">Enfermedades</th>
                    </thead>
                    <tbody>
                        @foreach ($sintomas as $sintoma)
                            <tr>
                                <td>
                                    @include('partials._boton', [
                                        'object' => $sintoma,
                                        'editRoute' => 'admin::sintomas::edit',
                                        'deleteRoute' => 'admin::sintomas::delete',
                                        'name' => $sintoma->name,
                                        'content' => 'el síntoma',
                                    ])
                                </td>
                                <td>{{ $sintoma->name }}</td>
                                <td>{{ $sintoma->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <span class="label label-primary">{{ $sintoma->rules->count() }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sintomas->render() !!}
            </div>
        </div>
    </div>
</div>
@include('partials._callout', [
    'type' => 'warning',
    'title' => 'Atención',
    'content' => 'Sólo se pueden eliminar síntomas sin enfermedades asociadas'])
@stop
