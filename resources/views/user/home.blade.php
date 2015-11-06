@extends('layouts.layoutuser')
@section('breadcrumb') Inicio @stop
@section('title') Inicio @stop
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $countDiagnostic }}</h3>
                    <p>Mis Diagnósticos Realizados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-md"></i>
                </div>
                <a href="{{ route('user::diagnosticos::index') }}" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $countDiseases }}</h3>
                    <p>Enfermedades</p>
                </div>
                <div class="icon">
                    <i class="fa fa-heartbeat"></i>
                </div>
                <a href="{{ route('user::enfermedades::index') }}" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $countSymptom }}</h3>
                    <p>Síntomas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-eyedropper"></i>
                </div>
                <a href="{{ route('user::sintomas::index') }}" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-title">Mis últimos diagnósticos</div>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Enfermedad</th>
                                <th>Realizado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnostics as $diagnostic)
                            <tr>
                                <td>{{ $diagnostic->disease->name }}</td>
                                <td>{{ $diagnostic->created_at->format('d-m-Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">Enfermedades y número de veces diagnosticada</div>
                </div>
                <div class="box-body">
                    <div id="user-diseases"></div>
                </div>
            </div>
        </div>
    </div>
@stop
