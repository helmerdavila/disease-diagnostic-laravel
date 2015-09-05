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
            'email' => 'required|email|unique:users,email',
            'password' => 'sometimes|min:6|max:20',
            'name' => 'required|min:3',
            'lastname' => 'min:3',
            'gender' => 'required|numeric',
            'birthday' => 'date_format:d/m/Y',
        ];
    }
}
