<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class UserRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'sometimes|required|email|unique:users,email',
            'password' => 'sometimes|min:6|max:20',
            'name'     => 'required|min:3|alpha_spaces',
            'lastname' => 'min:3',
            'gender'   => 'required|numeric',
            'birthday' => 'date_format:d/m/Y',
        ];
    }

    public function messages()
    {
        return [
            'email.unique'      => 'El correo ya se encuentra registrado en este sitio',
            'name.alpha_spaces' => 'El nombre solo debe contener letras',
            'birthday'          => 'La fecha de nacimiento debe tener el formato dd/mm/YYYY',
        ];
    }
}
