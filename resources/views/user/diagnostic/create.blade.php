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
                    {{--
                    @foreach ($sintomas as $index => $sintoma)
                        <input type="checkbox" name="sintomas[]" value="{{ $index }}" data-labelauty="{{ $sintoma }}"/>
                    @endforeach
                    --}}
                    {!! Form::submit('Continuar &raquo;', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
