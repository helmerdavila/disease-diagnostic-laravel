<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class ProfileRequest extends Request
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name'     => 'required|between:2,255',
            'lastname' => 'between:2,255',
            'email'    => 'required|email|max:255',
            'birthday' => 'date_format:d/m/Y',
            'phone'    => 'between:2,255',
            'mobil'    => 'between:2,255',
            'state'    => 'required|numeric',
            'gender'   => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'El nombre es obligatorio',
            'name.between'         => 'El nombre debe contener entre :min y :max caracteres',
            'lastname.between'     => 'El apellido debe contener entre :min y :max caracteres',
            'birthday.date_format' => 'La fecha debe tener un formato válido dd/mm/AAAA',
            'phone.between'        => 'El teléfono debe contener entre :min y :max caracteres',
            'mobil.between'        => 'El celular debe contener entre :min y :max caracteres',
            'state.required'       => 'El departamento es obligatorio',
            'state.numeric'        => 'El departamento debe ser un formato válido',
            'email.required'       => 'El correo debe ser obligatorio',
            'email.email'          => 'El correo debe tener formato de correo electrónico',
            'email.max'            => 'El correo debe tener como máximo :max caracteres',
            'gender.required'      => 'El género es obligatorio',
        ];
    }
}
