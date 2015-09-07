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
                    {!! Field::text('name', null, ['placeholder' => 'Nombre del Síntoma', 'autocomplete' => 'off', 'autofocus' => '', 'label' => 'Nombre']) !!}
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
                        <th>Enfermedades</th>
                    </thead>
                    <tbody>
                        @foreach ($sintomas as $sintoma)
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('admin::sintomas::edit', Hashids::encode($sintoma->id)) }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                            <li><a href=""><i class="fa fa-times"></i> Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $sintoma->name }}</td>
                                <td>{{ $sintoma->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sintomas->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
