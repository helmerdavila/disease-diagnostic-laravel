<?php

namespace Tesis\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use Tesis\Http\Requests\Request;

class DiseaseRequest extends Request
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
            'nombre' => 'required|min:3|max:255',
            'nombre_c' => 'required|min:3|max:1000',
            'sintomas' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre_c.required' => 'El campo nombre científico es obligatorio',
            'nombre_c.min' => 'El campo nombre científico debe tener al menos :min caracteres',
            'nombre_c.max' => 'El campo nombre científico debe tener al menos :max caracteres',
        ];
    }
}
