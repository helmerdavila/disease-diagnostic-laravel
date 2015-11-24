@extends('layouts.layoutadmin')
@section('title') Enfermedades @stop
@section('breadcrumb') Enfermedades @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nueva Regla</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    @include('admin.disease.form_new_rule')
                    {!! Form::submit('Registrar Regla', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Reglas de {{ $enfermedad->name }}</strong></h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-gear"></i></th>
                                <th>ID Regla</th>
                                <th>Regla</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reglas as $index => $regla)
                                <tr>
                                    <td>
                                        <a href="" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#deleteModal"
                                            data-title="Eliminar Regla" data-content="esta regla"
                                            data-route="{{ route('admin::enfermedades::regla::delete', $index) }}">
                                        <i class="fa fa-times"></i> Eliminar</a>
                                    </td>
                                    <td>Regla {{ $index }}</td>
                                    <td>
                                        @foreach ($regla as $regla_sintoma)
                                            <span class="label label-primary">
                                                {{ $regla_sintoma->symptom->name }}
                                            </span>&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
