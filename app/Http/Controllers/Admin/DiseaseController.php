<?php

namespace Tesis\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\DiseaseRequest;
use Tesis\Http\Requests\SearchRequest;
use Tesis\Models\Disease;
use Tesis\Models\Rule;
use Tesis\Models\Symptom;
use Tesis\Traits\HashTrait;

class DiseaseController extends Controller
{
    use HashTrait;

    public function create()
    {
        $enfermedades = Disease::with('rules', 'diagnostics')->orderBy('name', 'asc')->paginate(10);

        return view('admin.disease.index')
            ->with('enfermedades', $enfermedades);
    }

    public function store(DiseaseRequest $request)
    {
        $enfermedad = Disease::create($request->all());

        alert('Se ingresó la enfermedad correctamente');
        return redirect()->back();
    }

    public function edit($hash_id)
    {
        $id         = $this->decode($hash_id);
        $enfermedad = Disease::findOrFail($id);

        $e_sintomas = $enfermedad->rules->lists('id')->toArray();

        return view('admin.disease.edit')
            ->with('e_sintomas', $e_sintomas)
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

    public function search(SearchRequest $request)
    {
        if (!$request->has('search')) {
            return redirect()->route('admin::enfermedades::create');
        }

        $enfermedades = Disease::search($request->search)->get();

        return view('admin.disease.result')->with('enfermedades', $enfermedades);
    }

    public function add_rule($hash_id, Request $request)
    {
        $enfermedad = Disease::findOrFail($this->decode($hash_id));
        $sintomas   = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();

        if ($request->isMethod('post')) {
            $lastRule = Rule::orderBy('id', 'desc')->first();

            if (is_null($lastRule)) {
                $numberRule = 1;
            } else {
                $numberRule = intval($lastRule->number) + 1;
            }

            foreach ($request->sintomas as $sintoma_id) {
                $sintoma = Symptom::findOrFail($sintoma_id);

                $rule         = new Rule;
                $rule->number = $numberRule;
                $rule->disease()->associate($enfermedad);
                $rule->symptom()->associate($sintoma);
                $rule->save();
            }

            alert('Se registró la regla con éxito');
            return redirect()->back();
        }

        $reglas = Rule::with('symptom')
            ->where('disease_id', $enfermedad->id)
            ->get()
            ->groupBy('number');

        return view('admin.disease.add_rule')
            ->with('enfermedad', $enfermedad)
            ->with('reglas', $reglas)
            ->with('sintomas', $sintomas);
    }
}
