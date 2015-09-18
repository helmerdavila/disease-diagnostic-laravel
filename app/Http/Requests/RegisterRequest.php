<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class RegisterRequest extends Request
{
    public function authorize()
    {
        return auth()->check() ? false : true;
    }

    public function rules()
    {
        return [
            'name' => 'required|between:2,255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|between:6,20',
            'password_confirmation' => 'required|between:6,20',
            'gender' => 'required|numeric',
            'confirmed' => 'accepted',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.between' => 'El nombre debe contener entre :min y :max caracteres',
            'email.required' => 'El correo debe ser obligatorio',
            'email.email' => 'El correo debe tener formato de correo electrónico',
            'email.max' => 'El correo debe tener como máximo :max caracteres',
            'email.unique' => 'El correo ya se encuentra registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'La contraseña y su confirmación no coinciden',
            'password.between' => 'La contraseña debe tener entre :min y :max caracteres',
            'password_confirmation.required' => 'La confirmación de contraseña es obligatoria',
            'password_confirmation.between' => 'La confirmación de contraseña debe tener entre :min y :max caracteres',
            'gender.required' => 'El género es obligatorio',
            'confirmed.accepted' => 'Debe aceptar los términos',
        ];
    }
}
