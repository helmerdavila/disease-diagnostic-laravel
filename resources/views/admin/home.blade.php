@extends('layouts.layoutadmin')
@section('breadcrumb')
	Inicio
@stop
@section('title')
	Inicio
@stop
@section('content')
	<div class="jumbotron">
		<h1>Bienvenido Administrador</h1>
		<p>Hoy es {{ date('d-m-Y') }}</p>
	</div>
@stop
