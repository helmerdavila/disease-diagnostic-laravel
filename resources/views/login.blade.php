<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Medico</title>
        {{-- Tell the browser to be responsive to screen width --}}
        `<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        {{-- Ionicons --}}
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
                <p class="login-box-msg">Ingresa tus datos para iniciar sesión</p>
                {!! Form::open(['route' => 'showLoginPost']) !!}
                {!! Alert::render() !!}
                <div class="form-group has-feedback {!! $errors->first('email', 'has-error') !!}">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="form-group has-feedback {!! $errors->first('password', 'has-error') !!}">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                    <span class="fa fa-lock form-control-feedback"></span>
                    {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" data-labelauty="No recordarme|Recordarme"/>
                            </label>
                        </div>
                    </div>{{-- /.col --}}
                    <div class="col-xs-5">
                        {!! Form::submit('Entrar', ['class' => 'btn btn-primary btn-block btn-flat']) !!}
                    </div>{{-- /.col --}}
                </div>
                {!! Form::close() !!}

                <div class="social-auth-links text-center">
                    <p>- o -</p>
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Iniciar sesión con Facebook</a>
                </div>{{-- /.social-auth-links --}}

                <a href="#">Olvidé mi contraseña</a><br>
                <a href="{{ route('showRegister') }}" class="text-center">Registrarse</a>
            </div>{{-- /.login-box-body --}}
        </div>{{-- /.login-box --}}

        {{-- Compiled scripts --}}
        <script src="{{ elixir('js/all.js') }}"></script>
    </body>
</html>