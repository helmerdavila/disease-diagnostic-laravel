@extends('layouts.layoutadmin')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Listado de Diagnósticos</strong></h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa fa-gear"></i></th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {!! $diagnostics->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
