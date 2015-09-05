@extends('layouts.layoutuser')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nuevo Diagnóstico</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Form::radios('sintomas', $sintomas) !!}
                    {!! Form::submit('Siguiente &raquo;', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
