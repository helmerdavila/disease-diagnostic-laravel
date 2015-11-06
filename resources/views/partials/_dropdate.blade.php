{{-- Drop para fecha --}}
{{-- Si el campo estÃ¡ vacÃ­o no hacer nada --}}
@unless (empty($name))
<div class="form-group">
    <label>{{ $label or 'Fecha' }}</label>
    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-default {{ $name }}calendar" type="button">
                <i class="fa fa-calendar"></i>
            </button>
        </span>
        @if (isset($field))
            {{-- No Borrar la linea inferior, convierte la fecha de cadena a objeto fecha Datetime --}}
            {{--*/ $field = \Carbon\Carbon::parse($field) /*--}}
        @endif
        @if (old($name))
            {!! Form::text($name, !empty($field) ? $field->format('d/m/Y') : old($name), ['class' => "form-control $name"]) !!}
        @else
            {!! Form::text($name, !empty($field) ? $field->format('d/m/Y') : old($name), ['class' => "form-control $name", 'disabled']) !!}
        @endif
        <span class="input-group-btn">
            <button class="btn btn-default {{ $name }}reset" type="button">Limpiar</button>
        </span>
    </div>
    {!! $errors->first($name, '<span class="text-danger">:message</span>') !!}
</div>
@endunless
