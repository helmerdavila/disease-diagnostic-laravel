<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\SymptomRequest;
use Tesis\Models\Symptom;
use Tesis\Traits\HashTrait;

class SymptomController extends Controller
{
    use HashTrait;

    public function create()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->with('rules')->paginate(10);

        return view('admin.symptom.index')->with('sintomas', $sintomas);
    }

    public function store(SymptomRequest $request)
    {
        Symptom::create($request->all());

        alert('Se registró el síntoma correctamente');
        return redirect()->back();
    }

    public function edit($hash_id)
    {
        $id = $this->decode($hash_id);

        $sintoma = Symptom::findOrFail($id);

        return view('admin.symptom.edit')->with('sintoma', $sintoma);
    }

    public function update($hash_id, SymptomRequest $request)
    {
        $id = $this->decode($hash_id);

        $sintoma = Symptom::findOrFail($id);
        $sintoma->update($request->all());

        alert('Se modificó el síntoma con éxito');
        return redirect()->route('admin::sintomas::create');
    }

    public function delete($hash_id)
    {
        $id = $this->decode($hash_id);

        $sintoma = Symptom::findOrFail($id);

        if ($sintoma->rules->count() > 0) {
            alert('No se puede eliminar un síntoma con reglas', 'danger');
            return redirect()->back();
        }

        $sintoma->delete();

        alert('Se eliminó el síntoma con éxito');
        return redirect()->route('admin::sintomas::listar');
    }
}
