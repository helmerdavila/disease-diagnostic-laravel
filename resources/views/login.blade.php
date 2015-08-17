<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio de Sesión</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1>Bienvenido al sistema</h1>
			<p>Logueate para poder acceder al sistema</p>
			{!! Form::open() !!}
				<div class="form-group">
					<label>Usuario</label>
					<input class="form-control" type="text" name="username">
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<input class="form-control" type="password" name="password">
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
