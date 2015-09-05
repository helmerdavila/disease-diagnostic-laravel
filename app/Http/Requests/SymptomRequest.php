<?php

namespace Tesis\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Tesis\Http\Requests\Request;

class SymptomRequest extends Request
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function authorize()
    {
        if ($this->auth->user()->hasRole('admin')) {
            return true;
        }
        return abort(403);
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nombre.min' => 'El nombre debe tener mínimo :min caracteres',
            'nombre.max' => 'El nombre debe tener máximo :min caracteres',
        ];
    }
}
