<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\DiseaseRequest;
use Tesis\Models\Disease;
use Tesis\Models\Rule;
use Tesis\Models\Symptom;
use Vinkla\Hashids\HashidsManager;

class DiseaseController extends Controller
{
    protected $hashids;

    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    public function index()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id');
        $enfermedades = Disease::with('rules', 'rules.symptom')->orderBy('name', 'asc')->paginate(20);

        return view('admin.disease.index')
            ->with('enfermedades', $enfermedades)
            ->with('sintomas', $sintomas->toArray());
    }

    public function create(DiseaseRequest $request)
    {
        $enfermedad = new Disease;
        $enfermedad->name = $request->input('nombre');
        $enfermedad->name_c = $request->input('nombre_c');
        if ($enfermedad->save()) {
            foreach ($request->input('sintomas') as $sintoma_id) {
                $regla = new Rule;
                $regla->disease_id = $enfermedad->id;
                $regla->symptom_id = $sintoma_id;
                $regla->save();
            }
            alert('Se ingresó la enfermedad correctamente', 'success');
        } else {
            alert('Hubo un problema al registrar la enfermedad, por favor intente nuevamente');
        }
        return redirect()->back();
    }

    public function edit($encrypt_id)
    {
        if (!empty($decoded = $this->hashids->decode($encrypt_id))) {
            if ($enfermedad = Disease::with('rules.symptom')->find($decoded[0])) {
                $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();
                $e_sintomas = $enfermedad->rules->lists('symptom_id')->toArray();
                return view('admin.disease.edit')
                    ->with('e_sintomas', $e_sintomas)
                    ->with('sintomas', $sintomas)
                    ->with('enfermedad', $enfermedad);
            }
        }
        return abort(404);
    }

    public function update($encrypt_id)
    {

    }
}
