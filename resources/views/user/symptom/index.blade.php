@extends('layouts.layoutuser')
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
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach ($sintomas as $sintoma)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading{{ $sintoma->id }}">
                            <h4 class="panel-title">
                                <a href="#collapse{{ $sintoma->id }}" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapse{{ $sintoma->id }}">
                                    {{ $sintoma->name }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $sintoma->id }}" class="panel panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $sintoma->id }}">
                            <div class="panel-body">
                                {{ $sintoma->description }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {!! $sintomas->render() !!}
            </div>
        </div>
    </div>
</div>
@stop
