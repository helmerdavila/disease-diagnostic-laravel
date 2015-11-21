{!! Field::selectMultiple('sintomas[]', $sintomas, !empty($e_sintomas) ? $e_sintomas : old('sintomas[]'), ['label' => 'Síntomas', 'class' => 'select2', 'data-width' => '100%']) !!}
{!! $errors->first('sintomas', '<p class="text-danger">:message</p>') !!}
