@extends('layouts.layoutadmin')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Búsqueda de Diagnósticos</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open(['method' => 'GET', 'route' => 'admin::diagnosticos::buscar']) !!}
                    @include('partials._search')
                {!! Form::close() !!}
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Género</th>
                            <th>Enfermedad</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diagnostics as $diagnostic)
                            <tr>
                                <td>{{ "{$diagnostic->user->name} {$diagnostic->user->lastname}" }}</td>
                                <th>{{ $diagnostic->user->getGender() }}</th>
                                <td>{{ $diagnostic->disease->name }}</td>
                                <td>{{ $diagnostic->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td>No se encontraron diagnósticos</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
