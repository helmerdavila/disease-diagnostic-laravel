@extends('layouts.layoutuser')
@section('breadcrumb') Inicio @stop
@section('title') Inicio @stop
@section('content')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="small-box bg-green">
				<div class="inner">
					<h3>{{ $countDiagnostic }}</h3>
					<p>Mis Diagnósticos Realizados</p>
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
					<div class="box-title">Gráfica con evolución de top 2 enfermedades</div>
				</div>
				<div class="box-body">
					Contenido
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="box box-success">
				<div class="box-header with-border">
					<div class="box-title">Últimos registrados (que aparezca incluso red social)</div>
				</div>
				<div class="box-body">
					Contenido
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-title">Donut char con enfermedades y cantidad de veces indicada</div>
				</div>
				<div class="box-body">
					Contenido
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="box box-warning">
				<div class="box-header with-border">
					<div class="box-title">Perfil del Administrador</div>
				</div>
				<div class="box-body">
					Contenido
				</div>
			</div>
		</div>
	</div>
@stop
