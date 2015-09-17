<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class DiseaseRequest extends Request
{
    public function authorize()
    {
        return auth()->user()->hasRole('admin') ? true : abort(403);
    }

    public function rules()
    {
        return [
            'name' => 'required|between:3,255',
            'name_c' => 'between:3,1000',
            'sintomas' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.between' => 'El nombre científico debe tener entre :min y :max caracteres',
            'name_c.between' => 'El nombre científico debe tener entre :min y :max caracteres',
            'sintomas.required' => 'Elegir sintomas es obligatorio',
        ];
    }
}
