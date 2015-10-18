@extends('layouts.layoutadmin')
@section('title')
    Usuarios
@stop
@section('breadcrumb')
    Usuarios
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid {!! count($errors) > 0 ? '' : 'collapsed-box' !!}">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nuevo Usuario</strong></h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse">
                        @if (count($errors) > 0)
                            <i class="fa fa-minus"></i>
                        @else
                            <i class="fa fa-plus"></i>
                        @endif
                    </button>
                </div>
            </div>
            <div class="box-body" {!! count($errors) > 0 ? 'style="display:block"' : '' !!}>
                {!! Form::open() !!}
                    @include('admin.user._form', ['buttonText' => 'Guardar', 'buttonColor' => 'success'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Listado de Usuarios</strong></h3>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa fa-gear"></i></th>
                            <th>Datos</th>
                            <th>Correo</th>
                            <th>Género</th>
                            <th>Nacimiento</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Registrado</th>
                            <th class="text-center">Diagnósticos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-gear"></i>  <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('admin::usuarios::edit', Hashids::encode($usuario->id)) }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                            <li><a href=""><i class="fa fa-times"></i> Eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $usuario->name }} {{ $usuario->lastname }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->getGender() }}</td>
                                <td>{{ isset($usuario->birthday) ? $usuario->birthday->format('d/m/Y') : '--' }}</td>
                                <td>{{ $usuario->phone }}</td>
                                <td>{{ $usuario->mobil }}</td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <span class="label label-primary">{{ count($usuario->diagnostics) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $usuarios->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
