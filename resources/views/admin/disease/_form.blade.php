{!! Field::text('name', !empty($disease) ? $disease->name : old('name') , ['label' => 'Nombre', 'autocomplete' => 'off', 'autofocus']) !!}
{!! Field::text('name_c', !empty($disease) ? $disease->name_c : old('name_c') , ['label' => 'Nombre Científico', 'autocomplete' => 'off']) !!}
{!! Field::textarea('description', !empty($disease) ? $disease->description : old('description'), ['label' => 'Descripción', 'ph' => 'Una descripción o información adicional de la enfermedad']) !!}
{!! Form::submit($buttonText, ['class' => "btn btn-$color"]) !!}
