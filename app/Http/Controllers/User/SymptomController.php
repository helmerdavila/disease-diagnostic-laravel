<?php

namespace Tesis\Http\Controllers\User;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Symptom;

class SymptomController extends Controller
{
    public function index()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->paginate(20);

        return view('user.symptom.index')->with('sintomas', $sintomas);
    }

    public function show($id)
    {
        //
    }
}
