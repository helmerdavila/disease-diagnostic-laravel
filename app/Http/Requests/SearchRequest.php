<?php

namespace Tesis\Http\Requests;

use Tesis\Http\Requests\Request;

class SearchRequest extends Request
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'search' => 'required',
        ];
    }
}
