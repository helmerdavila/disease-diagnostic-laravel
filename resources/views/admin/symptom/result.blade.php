@extends('layouts.layoutadmin')
@section('title') Búsqueda Síntomas @stop
@section('breadcrumb') Búsqueda Síntomas @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Búsqueda de Síntomas</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open(['method' => 'GET', 'route' => 'admin::sintomas::buscar']) !!}
                    @include('partials._search')
                {!! Form::close() !!}
                <table class="table table-responsive table-hover">
                    <thead>
                        <th><i class="fa fa-gear"></i></th>
                        <th>Nombre</th>
                        <th>Agregado</th>
                        <th class="text-center">Enfermedades</th>
                    </thead>
                    <tbody>
                        @forelse ($sintomas as $sintoma)
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
                        @empty
                            <tr>
                                <td>No se encontraron síntomas con ese nombre</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('partials._callout', [
    'type' => 'warning',
    'title' => 'Atención',
    'content' => 'Sólo se pueden eliminar síntomas sin enfermedades asociadas'])
@stop
