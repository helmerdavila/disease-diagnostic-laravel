@extends('layouts.layoutuser')
@section('title') Diagnósticos @stop
@section('breadcrumb') Diagnósticos @stop
@section('content')
@if (Session::has('session_sintomas'))
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <p><i class="fa fa-info"></i>&nbsp; Puede eliminar un síntoma ingresado haciendo clic sobre él</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Lista de Síntomas Ingresados</strong></h3>
                </div>
                <div class="box-body">
                    @foreach ($showSymptoms as $key => $symptom)
                        <a href="{{ route('user::diagnosticos::delete::symptom', $key) }}" class="label label-success">{{ $symptom }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Nuevo Diagnóstico</strong></h3>
            </div>
            <div class="box-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4>Elija uno de los siguientes síntomas a continuación</h4>
                {!! Form::open(['route' => 'user::diagnosticos::analyze']) !!}
                    <div class="form-group">
                        {!! Form::select('sintoma', $sintomas, null, ['class' => 'select2', 'data-width' => '100%']) !!}
                    </div>
                    {!! Form::submit('Continuar &raquo;', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
