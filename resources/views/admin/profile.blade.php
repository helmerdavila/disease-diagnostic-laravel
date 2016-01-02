@extends('layouts.layoutadmin')
@section('breadcrumb') Perfil @stop
@section('title') Perfil @stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img src="{{ asset('img/user.png') }}" class="profile-user-img img-responsive img-circle">
                    <h3 class="profile-username text-center">{{ auth()->user()->getFullName() }}</h3>
                    <p class="text-muted text-center">Administrador</p>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                @if ($errors->has('old_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                    <li><a href="#configuracion" data-toggle="tab">Configuración</a></li>
                    <li class="active"><a href="#password" data-toggle="tab">Contraseña</a></li>
                @else
                    <li class="active"><a href="#configuracion" data-toggle="tab">Configuración</a></li>
                    <li><a href="#password" data-toggle="tab">Contraseña</a></li>
                @endif
                </ul>

                <div class="tab-content">
                @if ($errors->has('old_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                    <div class="tab-pane" id="configuracion">
                @else
                    <div class="active tab-pane" id="configuracion">
                @endif
                        {!! Form::open(['route' => 'admin::perfil::actualizar']) !!}
                            {!! Field::text('email', auth()->user()->email, ['label' => 'Correo']) !!}
                            {!! Field::text('name', auth()->user()->name, ['label' => 'Nombre']) !!}
                            {!! Field::text('lastname', auth()->user()->lastname, ['label' => 'Apellidos']) !!}
                            {!! Field::radios('gender', [0 => 'Femenino', 1 => 'Masculino'], auth()->user()->gender, ['label' => 'Género']) !!}
                            {!! Field::text('birthday', isset(auth()->user()->birthday) ? auth()->user()->birthday->format('d/m/Y') : null, ['label' => 'Nacimiento']) !!}
                            {!! Field::text('phone', auth()->user()->phone, ['label' => 'Teléfono']) !!}
                            {!! Field::text('mobil', auth()->user()->mobil, ['label' => 'Celular']) !!}
                            {!! Field::select('state', $states, auth()->user()->state_id, ['label' => 'Departamento', 'class' => 'select2', 'data-width' => '100%']) !!}
                            {!! Form::submit('Actualizar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>

                @if ($errors->has('old_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                    <div class="active tab-pane" id="password">
                @else
                    <div class="tab-pane" id="password">
                @endif
                        {!! Form::open(['route' => 'admin::password::actualizar']) !!}
                            {!! Field::password('old_password', ['label' => 'Contraseña Antigua']) !!}
                            {!! Field::password('new_password', ['label' => 'Contraseña Nueva']) !!}
                            {!! Field::password('new_password_confirmation', ['label' => 'Contraseña Nueva (repita)']) !!}
                            {!! Form::submit('Actualizar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
