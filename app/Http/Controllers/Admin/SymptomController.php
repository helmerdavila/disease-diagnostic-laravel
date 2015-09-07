<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\SymptomRequest;
use Tesis\Models\Symptom;
use Vinkla\Hashids\HashidsManager;

class SymptomController extends Controller
{
    protected $hashids;

    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
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

    public function edit($encrypt_id)
    {
        if (!empty($decoded = $this->hashids->decode($encrypt_id))) {
            if ($sintoma = Symptom::find($decoded[0])) {
                return view('admin.symptom.edit')->with('sintoma', $sintoma);
            }
        }
        return abort(404);
    }

    public function update($encrypt_id, SymptomRequest $request)
    {
        if (!empty($decoded = $this->hashids->decode($encrypt_id))) {
            if ($sintoma = Symptom::find($decoded[0])) {
                $sintoma->update($request->all());
                alert('Se modificó el síntoma con éxito');
                return redirect()->route('admin::sintomas::index');
            }
        }

        return abort(404);
    }
}
