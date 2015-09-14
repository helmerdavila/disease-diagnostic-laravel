@extends('layouts.layoutadmin')
@section('title') Enfermedades @stop
@section('breadcrumb') Enfermedades @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nueva Enfermedad</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    @include('admin.disease._form', ['buttonText' => 'Guardar', 'color' => 'success'])
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
                            <th><i class="fa fa-gear"></i></th>
                            <th>Nombre</th>
                            <th>Nombre Científico</th>
                            <th>Síntomas</th>
                            <th>Agregado</th>
                            <th class="text-center">Diagnósticos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enfermedades as $enfermedad)
                            <tr>
                                <td>
                                    @include('partials._boton', [
                                        'object' => $enfermedad,
                                        'editRoute' => 'admin::enfermedades::edit',
                                        'deleteRoute' => 'admin::enfermedades::delete',
                                        'name' => $enfermedad->name . " ($enfermedad->name_c)",
                                        'content' => 'la enfermedad',
                                    ])
                                </td>
                                <td>{{ $enfermedad->name }}</td>
                                <td>{{ $enfermedad->name_c }}</td>
                                <td>
                                    @foreach ($enfermedad->rules as $sintoma)
                                        <span class="label label-primary">{{ $sintoma->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $enfermedad->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <span class="label label-primary">{{ $enfermedad->diagnostics->count() }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
