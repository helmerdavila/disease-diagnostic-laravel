<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Medico</title>
        {{-- Tell the browser to be responsive to screen width --}}
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <p class="login-box-msg">Ingresa los siguientes datos para continuar</p>
                {!! Form::open(['url' => '/password/reset']) !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group has-feedback {!! $errors->first('email', 'has-error') !!}">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required>
                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group has-feedback {!! $errors->first('password', 'has-error') !!}">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Contraseña" required>
                        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group has-feedback {!! $errors->first('password_confirmation', 'has-error') !!}">
                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirmar Contraseña" required>
                        {!! $errors->first('password_confirmation', '<p class="text-danger">:message</p>') !!}
                    </div>
                    {!! Form::submit('Restaurar contraseña', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                {!! Form::close() !!}
            </div>{{-- /.login-box-body --}}
        </div>{{-- /.login-box --}}

        {{-- Compiled scripts --}}
        <script src="{{ elixir('js/all.js') }}"></script>
    </body>
</html>
