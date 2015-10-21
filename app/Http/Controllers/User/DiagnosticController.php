<?php

namespace Tesis\Http\Controllers\User;

use Illuminate\Http\Request;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;
use Tesis\Traits\HashTrait;

class DiagnosticController extends Controller
{
    use HashTrait;

    public function index()
    {
        $diagnosticos = Diagnostic::where('user_id', auth()->id())->paginate(20);

        return view('user.diagnostic.index')->with('diagnosticos', $diagnosticos);
    }

    public function create()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();

        return view('user.diagnostic.create')->with('sintomas', $sintomas);
    }

    public function analyze(Request $request)
    {
        $this->validate($request, ['sintomas' => 'required|min:2']);

        $enfermedades = Disease::whereSymptoms($request->sintomas)->get();

        // sino hay enfermedad se redirige a una pagina diciendo que de nuevo
        // proceda a ingresar los sintomas refinando su busqueda
        if (empty($enfermedades)) {
            return redirect()->route('user::diagnosticos::show');
        }

        $enfermedad = $enfermedades->filter(function ($enfermedad) use ($request) {

            $numero_sintomas = count($request->sintomas);

            foreach ($enfermedad->rules as $rule) {
                $numero_sintomas--;
            }

            return ($numero_sintomas === 0) ? true : false;

        })->first();

        $diagnostico = new Diagnostic();
        $diagnostico->disease_id = $enfermedad->id;
        $diagnostico->user_id = $request->user()->id;
        $diagnostico->save();

        return redirect()
            ->route('user::diagnosticos::show', $this->encode($diagnostico->id));
    }

    public function show($hashed = null)
    {
        if (is_null($hashed)) {
            return view('user.diagnostic.show');
        }

        $id = $this->decode($hashed);

        $diagnostico = Diagnostic::findOrFail($id);

        if ($diagnostico->user_id != auth()->id()) {
            return redirect()->back();
        }

        return view('user.diagnostic.show')->with('diagnostico', $diagnostico);
    }
}
