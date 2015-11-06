@if(empty($usuario))
    {!! Field::email('email', !empty($usuario) ? $usuario->email : old('email'), ['label' => 'Correo Electrónico(*)']) !!}
	{!! Field::password('password', ['label' => 'Contraseña(*)']) !!}
@endif
{!! Field::text('name', !empty($usuario) ? $usuario->name : old('name'), ['label' => 'Nombre(*)']) !!}
{!! Field::text('lastname', !empty($usuario) ? $usuario->lastname : old('lastname'), ['label' => 'Apellidos', 'placeholder' => 'Opcional']) !!}
{!! Field::radios('gender', ['1' => 'Masculino', '0' => 'Femenino'], !empty($usuario) ? $usuario->gender : old('gender'), ['label' => 'Género']) !!}
{!! Field::select('state', $states, !empty($usuario) ? $usuario->state_id : old('state'), ['label' => 'Departamento', 'empty' => false, 'class' => 'select2', 'data-width' => '100%']) !!}
@unless (empty($usuario))
    @include('partials._dropdate', [
        'label' => 'Fecha de Nacimiento (Opcional)',
        'name' => 'birthday',
        'field' => $usuario->birthday,
    ])
@else
    @include('partials._dropdate', [
        'label' => 'Fecha de Nacimiento (Opcional)',
        'name' => 'birthday',
    ])
@endunless
{!! Field::text('phone', !empty($usuario) ? $usuario->phone : old('phone'), ['label' => 'Teléfono', 'placeholder' => 'Opcional']) !!}
{!! Field::text('mobil', !empty($usuario) ? $usuario->mobil : old('mobil'), ['label' => 'Celular', 'placeholder' => 'Opcional']) !!}
<div class="form-group">
	{!! Form::submit($buttonText, ['class' => "btn btn-$buttonColor"]) !!}
</div>
{!! Form::label('nota', '(*) Campos obligatorios', ['class' => 'control-label']) !!}
