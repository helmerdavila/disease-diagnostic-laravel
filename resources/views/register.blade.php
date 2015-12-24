<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Medico</title>
        {{-- Tell the browser to be responsive to screen width --}}
        `<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{-- Compiled scripts --}}
        <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>MI</b>Medico</a>
            </div>{{-- /.login-logo --}}
            <div class="login-box-body">
                <p class="login-box-msg">Ingresa tus datos para registrarte</p>
                {!! Form::open() !!}
                {!! Alert::render() !!}
                <label class="label-control">Datos</label>
                <div class="form-group has-feedback {!! $errors->first('name', 'has-error') !!}">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre">
                    <span class="fa fa-user form-control-feedback"></span>
                    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="form-group has-feedback {!! $errors->first('email', 'has-error') !!}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="form-group has-feedback {!! $errors->first('password_confirmation', 'has-error') !!}">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Contraseña">
                    <span class="fa fa-sign-in form-control-feedback"></span>
                    {!! $errors->first('password_confirmation', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="form-group has-feedback {!! $errors->first('password', 'has-error') !!}">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    <span class="fa fa-lock form-control-feedback"></span>
                    {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                </div>
                {{-- Departamentos --}}
                {!! Field::select('state', $states, null, ['label' => 'Departamento', 'empty' => false, 'class' => 'select2']) !!}
                {{-- Géneros --}}
                {!! Field::radios('gender', ['1' => 'Masculino', '2' => 'Femenino'], ['label' => 'Género']) !!}
                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox recordar">
                            <input type="checkbox" name="confirmed" data-labelauty="Acepto los términos"/>
                            {!! $errors->first('confirmed', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>{{-- /.col --}}
                    <div class="col-xs-6">
                        {!! Form::submit('Registrarse', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                    </div>{{-- /.col --}}
                </div>
                {!! Form::close() !!}

                <a href="{{ route('showLogin') }}">Ya tengo cuenta</a><br>
            </div>{{-- /.login-box-body --}}
        </div>{{-- /.login-box --}}

        {{-- Compiled scripts --}}
        <script src="{{ elixir('js/all.js') }}"></script>
    </body>
</html>
