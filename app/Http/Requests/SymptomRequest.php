<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class SymptomRequest extends Request
{
    public function authorize()
    {
        return auth()->user()->hasRole('admin') ? true : abort(403);
    }

    public function rules()
    {
        return [
            'name' => 'required|between:2,255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.between' => 'El nombre debe tener entre :min y :max caracteres',
        ];
    }
}
