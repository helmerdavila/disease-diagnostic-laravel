@extends('layouts.layoutadmin')
@section('title') {{ trans('messages.label.symptoms') }} @stop
@section('breadcrumb') {{ trans('messages.label.symptoms') }} @stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>{{ trans('messages.label.symptom.new') }}</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
                    {!! Field::text('name', null, [
                        'ph' => trans('messages.label.symptom.name'),
                        'autocomplete' => 'off',
                        'autofocus' => '',
                        'label' => trans('messages.label.name')
                    ]) !!}
                    {!! Field::text('description', null, [
                        'ph' => trans('messages.label.symptom.description'),
                        'autocomplete' => 'off',
                        'label' => trans('messages.label.description')
                    ]) !!}
                    {!! Form::submit(trans('messages.label.save'), ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>{{ trans('messages.label.symptom.list') }}</strong></h3>
            </div>
            <div class="box-body">
                {!! Form::open(['method' => 'GET', 'route' => 'admin::sintomas::buscar']) !!}
                    @include('partials._search')
                {!! Form::close() !!}
                <table class="table table-responsive table-hover">
                    <thead>
                        <th><i class="fa fa-gear"></i></th>
                        <th>{{ trans('messages.label.name') }}</th>
                        <th>{{ trans('messages.label.created') }}</th>
                        <th class="text-center">{{ trans('messages.label.diseases') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($sintomas as $sintoma)
                            <tr>
                                <td>
                                    @include('partials._boton', [
                                        'object' => $sintoma,
                                        'editRoute' => 'admin::sintomas::edit',
                                        'deleteRoute' => 'admin::sintomas::delete',
                                        'name' => $sintoma->name,
                                        'content' => 'el síntoma',
                                    ])
                                </td>
                                <td>{{ $sintoma->name }}</td>
                                <td>{{ $sintoma->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <span class="label label-primary">{{ $sintoma->rules->count() }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $sintomas->render() !!}
            </div>
        </div>
    </div>
</div>
@include('partials._callout', [
    'type' => 'warning',
    'title' => trans('messages.alert.warning'),
    'content' => trans('messages.alert.symptom')])
@stop
