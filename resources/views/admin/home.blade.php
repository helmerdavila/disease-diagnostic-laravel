@extends('layouts.layoutadmin')
@section('breadcrumb') {{ trans('messages.label.home') }} @stop
@section('title') {{ trans('messages.label.home') }} @stop
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $countDiagnostic }}</h3>
                    <p>{{ trans('messages.label.diagnostics') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-md"></i>
                </div>
                <a href="{{ route('admin::diagnosticos::index') }}" class="small-box-footer">
                    {{ trans('messages.label.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $countDiseases }}</h3>
                    <p>{{ trans('messages.label.diseases') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-heartbeat"></i>
                </div>
                <a href="{{ route('admin::enfermedades::create') }}" class="small-box-footer">
                    {{ trans('messages.label.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $countSymptom }}</h3>
                    <p>{{ trans('messages.label.symptoms') }}</p>
                </div>
                <div class="icon">
                    <i class="fa fa-eyedropper"></i>
                </div>
                <a href="{{ route('admin::sintomas::create') }}" class="small-box-footer">
                    {{ trans('messages.label.more_info') }} <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    @if ($countDiagnostic > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('messages.label.top_two') }}</div>
                </div>
                <div class="box-body">
                    <div id="firstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('messages.label.last_registered') }}</div>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>{{ trans('messages.label.names') }}</th>
                                <th>{{ trans('messages.label.gender') }}</th>
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
        @if ($countDiagnostic > 0)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('messages.label.diseases') }} {{ trans('messages.label.and') }} {{ trans('messages.label.diagnostics') }}</div>
                </div>
                <div class="box-body">
                    <div id="firstdonut"></div>
                </div>
            </div>
        </div>
        @endif
    </div>
@stop
