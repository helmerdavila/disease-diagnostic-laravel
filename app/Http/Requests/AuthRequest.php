<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class AuthRequest extends Request
{
    public function authorize()
    {
        return auth()->check() ? false : true;
    }

    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es requerido',
            'password.required' => 'Se necesita una contraseña para continuar',
        ];
    }
}
