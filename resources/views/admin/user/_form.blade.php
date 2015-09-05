{!! Field::email('email', isset($usuario) ? $usuario->email : old('email'), ['label' => 'Correo Electrónico(*)']) !!}
@if(!isset($usuario))
	{!! Field::password('password', ['label' => 'Contraseña(*)']) !!}
@endif
{!! Field::text('name', isset($usuario) ? $usuario->name : old('name'), ['label' => 'Nombre(*)']) !!}
{!! Field::text('lastname', isset($usuario) ? $usuario->lastname : old('lastname'), ['label' => 'Apellidos', 'placeholder' => 'Opcional']) !!}
{!! Form::radios('gender', ['1' => 'Masculino', '0' => 'Femenino'], isset($usuario) ? $usuario->gender : old('gender')) !!}
{!! Field::text('birthday', isset($usuario) ? $usuario->birthday->format('d/m/Y') : old('birthday'), ['label' => 'Nacimiento', 'placeholder' => 'Opcional']) !!}
{!! Field::text('phone', isset($usuario) ? $usuario->phone : old('phone'), ['label' => 'Teléfono', 'placeholder' => 'Opcional']) !!}
{!! Field::text('mobil', isset($usuario) ? $usuario->mobil : old('mobil'), ['label' => 'Celular', 'placeholder' => 'Opcional']) !!}
<div class="form-group">
	{!! Form::submit($buttonText, ['class' => "btn btn-$buttonColor"]) !!}
</div>
{!! Form::label('nota', '(*) Campos obligatorios', ['class' => 'control-label']) !!}
