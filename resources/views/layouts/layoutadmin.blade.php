<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | MiMedico</title>
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

    <body class="hold-transition skin-blue-light sidebar-mini">
        {{-- Site wrapper --}}
        <div class="wrapper">
            <header class="main-header">
              {{-- Logo --}}
              <a href="{{ route('admin::home') }}" class="logo">
                {{-- mini logo for sidebar mini 50x50 pixels --}}
                <span class="logo-mini"><b>M</b>M</span>
                {{-- logo for regular state and mobile devices --}}
                <span class="logo-lg"><b>MI</b>Médico</span>
              </a>
              {{-- Header Navbar: style can be found in header.less --}}
                <nav class="navbar navbar-static-top" role="navigation">
                    {{-- Sidebar toggle button--}}
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            {{-- User Account: style can be found in dropdown.less --}}
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('img/user.png') }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    {{-- User image --}}
                                    <li class="user-header">
                                        <img src="{{ asset('img/user.png') }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ auth()->user()->name }} - {{ auth()->user()->roles->first()->display_name }}
                                            <small>{{ trans('messages.label.since') }} {{ auth()->user()->created_at->format('d-m-Y') }}</small>
                                        </p>
                                    </li>
                                    {{-- Menu Footer--}}
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('admin::perfil') }}" class="btn btn-default btn-flat">
                                                {{ trans('messages.label.profile') }}
                                            </a>
                                        </div>
                                        <div class="pull-right">
                                            <a href={{ route('logoutSession') }} class="btn btn-default btn-flat">
                                                {{ trans('messages.label.logout') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            {{-- =============================================== --}}
            {{-- Left side column. contains the sidebar --}}
            <aside class="main-sidebar">
                {{-- sidebar: style can be found in sidebar.less --}}
                <section class="sidebar">
                    {{-- Sidebar user panel --}}
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('img/user.png') }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ auth()->user()->name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('messages.label.online') }}</a>
                        </div>
                    </div>
                    {{-- sidebar menu--}}
                    <ul class="sidebar-menu">
                        <li class="header">{{ trans('messages.label.menu') }}</li>
                        <li>
                            <a href="{{ route('admin::home') }}">
                                <i class="fa fa-home"></i> <span>{{ trans('messages.label.home') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::sintomas::create') }}">
                                <i class="fa fa-eyedropper"></i> <span>{{ trans('messages.label.symptoms') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::enfermedades::create') }}">
                                <i class="fa fa-heartbeat"></i> <span>{{ trans('messages.label.diseases') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::diagnosticos::index') }}">
                                <i class="fa fa-user-md"></i> <span>{{ trans('messages.label.diagnostics') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::usuarios::create') }}">
                                <i class="fa fa-users"></i> <span>{{ trans('messages.label.patients') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::states::create') }}">
                                <i class="fa fa-institution"></i> <span>{{ trans('messages.label.states') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin::reportes::index') }}">
                                <i class="fa fa-area-chart"></i> <span>{{ trans('messages.label.reports') }}</span>
                            </a>
                        </li>
                    </ul>
                </section>
                {{-- /.sidebar --}}
            </aside>
            {{-- =============================================== --}}
            {{-- Content Wrapper. Contains page content --}}
            <div class="content-wrapper">
                {{-- Content Header (Page header) --}}
                <section class="content-header">
                    <h1><i class="fa fa-stethoscope"></i> MiMedico</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('admin::home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">@yield('breadcrumb')</li>
                    </ol>
                </section>
                {{-- Main content --}}
                <section class="content">
                    {{-- Genera alertas --}}
                    {!! Alert::render() !!}
                    {{-- Se puede agregar contenido en este bloque --}}
                    @yield('content')
                    {{-- Modal --}}
                    @include('partials._modal')
                </section>{{-- /.content --}}
            </div>{{-- /.content-wrapper --}}
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>&copy; {{ date('Y') }} Dávila Mundaca Helmer &amp; Nomberto Coronado Lesly</strong>
            </footer>
        </div>{{-- ./wrapper --}}
        {{-- Compiled scripts --}}
        <script src="{{ elixir('js/all.js') }}"></script>
        <script src="{{ asset('build/js/morris.min.js') }}"></script>
        <script src="{{ asset('build/js/graphs.js') }}"></script>
    </body>
</html>
