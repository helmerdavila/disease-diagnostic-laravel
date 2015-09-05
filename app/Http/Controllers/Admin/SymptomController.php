<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\SymptomRequest;
use Tesis\Models\Symptom;

class SymptomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->paginate(20);

        return view('admin.symptom.index')->with('sintomas', $sintomas);
    }

    public function create(SymptomRequest $request)
    {
        if (Symptom::create($request->all())) {
            alert('Se registró el síntoma correctamente', 'success');
        } else {
            alert('Hubo un problema al registrar el síntoma, por favor intente nuevamente', 'danger');
        }
        return redirect()->back();
    }
}
