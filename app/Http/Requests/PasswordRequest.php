<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class PasswordRequest extends Request
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'old_password'              => 'required',
            'new_password'              => 'required|confirmed|between:6,20',
            'new_password_confirmation' => 'required|between:6,20',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required'              => 'La contraseña antigua es obligatoria',
            'new_password.required'              => 'La nueva contraseña es obligatoria',
            'new_password.confirmed'             => 'La nueva contraseña y su confirmación no coinciden',
            'new_password.between'               => 'La nueva contraseña debe tener entre :min y :max caracteres',
            'new_password_confirmation.required' => 'La confirmación de nueva contraseña es obligatoria',
            'new_password_confirmation.between'  => 'La confirmación de nueva contraseña debe tener entre :min y :max caracteres',
        ];
    }
}
