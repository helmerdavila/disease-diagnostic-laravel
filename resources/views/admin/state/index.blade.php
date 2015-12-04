@extends('layouts.layoutadmin')
@section('title') Estado @stop
@section('breadcrumb') Estado @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nuevo Estado</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('name', null, ['ph' => 'Nombre del Estado', 'autocomplete' => 'off', 'autofocus' => '', 'label' => 'Nombre']) !!}
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
                <h3 class="box-title"><strong>Listado de Estados</strong></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th><i class="fa fa-gear"></i></th>
                        <th>Nombre</th>
                        <th class="text-center">Usuarios</th>
                    </thead>
                    <tbody>
                        @foreach ($states as $state)
                            <tr>
                                <td>
                                    @include('partials._boton', [
                                        'object' => $state,
                                        'editRoute' => 'admin::states::edit',
                                        'deleteRoute' => 'admin::states::delete',
                                        'name' => $state->name,
                                        'content' => 'el estado',
                                    ])
                                </td>
                                <td>{{ $state->name }}</td>
                                <td class="text-center">
                                    <span class="label label-primary">{{ $state->users->count() }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('partials._callout', [
    'type' => 'warning',
    'title' => 'Atención',
    'content' => 'Sólo se pueden eliminar estados sin usuarios'])
@stop
