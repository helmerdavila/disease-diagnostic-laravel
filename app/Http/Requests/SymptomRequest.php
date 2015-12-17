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
        if ($this->input('edit_boolean') == 1) {
            return [
                'name' => 'required|between:2,255',
            ];
        }
        return [
            'name' => 'required|between:2,255|unique:symptoms',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.between'  => 'El nombre debe tener entre :min y :max caracteres',
            'name.unique'   => 'El valor ingresado ya se encuentra registrado',
        ];
    }
}
