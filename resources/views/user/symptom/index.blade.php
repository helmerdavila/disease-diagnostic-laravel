@extends('layouts.layoutadmin')
@section('title') Síntomas @stop
@section('breadcrumb') Síntomas @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Listado de Síntomas e Información</strong></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th><i class="fa fa-gear"></i></th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </thead>
                    <tbody>
                        @foreach ($sintomas as $sintoma)
                        <tr>
                            <td>
                                <a class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <td>{{ $sintoma->name }}</td>
                            <td>{{ $sintoma->description }}</td>
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
