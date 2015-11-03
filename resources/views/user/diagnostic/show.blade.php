@extends('layouts.layoutuser')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Resultado de Diagnóstico</strong></h3>
            </div>
            <div class="box-body">
                <div class="jumbotron">
                    @unless (empty($diagnostico))
                        <h5>Usted padece</h5>
                        <h1>{{ $diagnostico->disease->name }}</h1>
                        <p>Descripción de Enfermedad</p>
                    @else
                        <h5>Usted no padece ningúna enfermedad</h5>
                        <p>El sistema no ha logrado encontar alguna enfermedad con los síntomas ingresados
                        revise los síntomas que ingresó</p>
                    @endunless
                </div>
            </div>
        </div>
    </div>
</div>
@stop
