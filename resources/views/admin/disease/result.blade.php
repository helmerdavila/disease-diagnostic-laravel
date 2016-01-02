@extends('layouts.layoutadmin')
@section('title') Búsqueda Enfermedades @stop
@section('breadcrumb') Búsqueda Enfermedades @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Búsqueda de Enfermedades</strong></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    {!! Form::open(['method' => 'GET', 'route' => 'admin::enfermedades::buscar']) !!}
                        @include('partials._search')
                    {!! Form::close() !!}
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-gear"></i></th>
                                <th>Nombre</th>
                                <th>Nombre Científico</th>
                                <th>Agregado</th>
                                <th class="text-center">Diagnósticos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($enfermedades as $enfermedad)
                                <tr>
                                    <td>
                                        @include('admin.disease.boton')
                                    </td>
                                    <td>{{ $enfermedad->name }}</td>
                                    <td>{{ $enfermedad->name_c }}</td>
                                    <td>{{ $enfermedad->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <span class="label label-primary">{{ $enfermedad->diagnostics->count() }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No se encontraron enfermedades con ese nombre</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
