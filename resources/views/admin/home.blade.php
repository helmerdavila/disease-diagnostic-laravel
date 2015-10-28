@extends('layouts.layoutadmin')
@section('breadcrumb')
    Inicio
@stop
@section('title')
    Inicio
@stop
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $countDiagnostic }}</h3>
                    <p>Diagnósticos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-md"></i>
                </div>
                <a href="" class="small-box-footer">
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
                <a href="" class="small-box-footer">
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
                <a href="" class="small-box-footer">
                    Más información <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="box-title">Top 2 enfermedades diagnosticadas</div>
                </div>
                <div class="box-body">
                    <div id="firstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-title">Últimos registrados</div>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Datos</th>
                                <th>Género</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastRegistered as $registered)
                            <tr>
                                <td>{{ $registered->name }} {{ $registered->lastName }}</td>
                                <td>{!! $registered->getGenderColored() !!}</td>
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
                    <div class="box-title">Enfermedades y Diagnósticos</div>
                </div>
                <div class="box-body">
                    <div id="firstdonut"></div>
                </div>
            </div>
        </div>
    </div>
@stop
