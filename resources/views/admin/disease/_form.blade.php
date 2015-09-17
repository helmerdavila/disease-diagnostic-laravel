{!! Field::text('name', !empty($disease) ? $disease->name : old('name') , ['label' => 'Nombre', 'autocomplete' => 'off', 'autofocus']) !!}
{!! Field::text('name_c', !empty($disease) ? $disease->name_c : old('name_c') , ['label' => 'Nombre Científico', 'autocomplete' => 'off']) !!}
<div class="form-group {{ $errors->has('sintomas') ? 'has-error' : '' }}">
    <label class="control-label">Síntomas</label>
    {!! Form::select('sintomas[]', $sintomas, !empty($e_sintomas) ? $e_sintomas : old('sintomas') , ['multiple','class' => 'select2 form-control']) !!}
    {!! $errors->first('sintomas', '<p class="text-danger">:message</p>') !!}
</div>
{!! Form::submit($buttonText, ['class' => "btn btn-$color"]) !!}
