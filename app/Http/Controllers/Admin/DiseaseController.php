<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\DiseaseRequest;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;
use Tesis\Traits\HashTrait;

class DiseaseController extends Controller
{
    use HashTrait;

    public function create()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();
        $enfermedades = Disease::with('rules')->orderBy('name', 'asc')->paginate(10);

        return view('admin.disease.index')
            ->with('enfermedades', $enfermedades)
            ->with('sintomas', $sintomas);
    }

    public function store(DiseaseRequest $request)
    {
        $enfermedad = Disease::create($request->all());

        /*
        foreach ($request->input('sintomas') as $sintoma_id) {
        $regla = new Rule;
        $regla->disease_id = $enfermedad->id;
        $regla->symptom_id = $sintoma_id;
        $regla->save();
        }
         */
        $enfermedad->rules()->sync($request->input('sintomas'));

        alert('Se ingresó la enfermedad correctamente');
        return redirect()->back();
    }

    public function edit($hash_id)
    {
        $id = $this->decode($hash_id);
        $enfermedad = Disease::findOrFail($id);
        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();
        $e_sintomas = $enfermedad->rules->lists('id')->toArray();

        return view('admin.disease.edit')
            ->with('e_sintomas', $e_sintomas)
            ->with('sintomas', $sintomas)
            ->with('enfermedad', $enfermedad);
    }

    public function update($hash_id, DiseaseRequest $request)
    {
        $id = $this->decode($hash_id);

        $enfermedad = Disease::findOrFail($id);

        $enfermedad->update($request->all());

        $enfermedad->rules()->sync($request->input('sintomas'));

        alert('Se actualizó la enfermedad correctamente');
        return redirect()->route('admin::enfermedades::create');
    }

    public function delete($hash_id)
    {
        $id = $this->decode($hash_id);

        $enfermedad = Disease::findOrFail($id);

        if ($enfermedad->diagnostics->count() > 0) {
            alert('No se puede eliminar una enfermedad con diagnósticos');
            return redirect()->back();
        }

        $enfermedad->delete();

        alert('Se eliminó la enfermedad correctamente', 'danger');
        return redirect()->back();
    }
}
