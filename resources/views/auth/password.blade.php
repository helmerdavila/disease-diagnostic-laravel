<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Medico</title>
        {{-- Tell the browser to be responsive to screen width --}}
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                <p class="login-box-msg">Ingresa tu correo para continuar</p>
                {!! Form::open() !!}
                    {!! Alert::render() !!}
                    <div class="form-group has-feedback {!! $errors->first('email', 'has-error') !!}">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo" required>
                        <span class="fa fa-envelope form-control-feedback"></span>
                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                    </div>
                    {!! Form::submit('Enviar correo de restauración', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                {!! Form::close() !!}
                <a href="/">Regresar al inicio</a><br>
            </div>{{-- /.login-box-body --}}
        </div>{{-- /.login-box --}}

        {{-- Compiled scripts --}}
        <script src="{{ elixir('js/all.js') }}"></script>
    </body>
</html>
