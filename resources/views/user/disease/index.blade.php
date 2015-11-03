@extends('layouts.layoutuser')
@section('title') Síntomas @stop
@section('breadcrumb') Síntomas @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Listado de Enfermedades e Información</strong></h3>
            </div>
            <div class="box-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach ($enfermedades as $enfermedad)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading{{ $enfermedad->id }}">
                            <h4 class="panel-title">
                                <a href="#collapse{{ $enfermedad->id }}" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapse{{ $enfermedad->id }}">
                                    {{ $enfermedad->name }} {{ !empty($enfermedad->name_c) ? "($enfermedad->name_c)" : '' }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $enfermedad->id }}" class="panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $enfermedad->id }}">
                            <div class="panel-body">
                                {{ $enfermedad->description or 'No hay una descripción para esta enfermedad' }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {!! $enfermedades->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
