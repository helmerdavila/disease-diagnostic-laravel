<?php

namespace Tesis\Http\Controllers\User;

use Illuminate\Http\Request;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Rule;
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

    public function create(Request $request)
    {
        if ($request->session()->has('session_sintomas')) {
            $request->session()->forget('session_sintomas');
        }

        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();

        return view('user.diagnostic.create')->with('sintomas', $sintomas);
    }

    public function analyze(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'sintoma' => 'required',
            ], [
                'sintoma.required' => 'Debe seleccionar un síntoma para continuar',
            ]);

            if ($request->session()->has('session_sintomas')) {
                // Acá busca si el elemento no está en el array de session, para agregarlo
                $sessionSymptoms = $request->session()->get('session_sintomas');
                if (!in_array($request->sintoma, $sessionSymptoms)) {
                    $sessionSymptoms[] = $request->sintoma;
                    $request->session()->put(['session_sintomas' => $sessionSymptoms]);
                }
            } else {
                $request->session()->put(['session_sintomas' => [$request->sintoma]]);
            }
        }

        $sessionSymptoms = $request->session()->get('session_sintomas');

        // Buscamos reglas con los síntomas obtenidos de la sesión primero buscando
        // por síntomas  y después buscando por número de regla
        $rules = Rule::with('symptom')->whereIn('symptom_id', $sessionSymptoms)->get()->groupBy('number');

        list($rulesKeys, $value) = array_divide($rules->toArray());

        $rules = Rule::with('symptom')->whereIn('number', $rulesKeys)->get()->groupBy('number');

        $rules = $rules->map(function ($value, $key) {
            return $value->groupBy('symptom_id');
        });

        $symptomForSelect = [];
        $diagnosticId     = 0;
        //dd($rules);
        $rules->each(function ($ruleNumber, $key) use ($sessionSymptoms, &$symptomForSelect, $request, &$diagnosticId) {
            list($symptomKeys, $someRule) = array_divide($ruleNumber->toArray());
            $difference                   = array_diff($symptomKeys, $sessionSymptoms);
            // Si esta vacío significa que no hay diferencias
            if (empty($difference)) {
                // tomamos el primer elemento del primer elemento de la colleccion
                // (está ordenado por id_sintoma)
                $diseaseKey   = $ruleNumber->first()->first()->disease_id;
                $diagnosticId = $this->generateDiagnostic($diseaseKey, $request->user()->id);
                return false;
            } else {
                $tempSymptoms = Symptom::findOrFail($difference);
                foreach ($tempSymptoms as $tempSymptom) {
                    $symptomForSelect[$tempSymptom->id] = $tempSymptom->name;
                }
            }
        });

        if (empty($diagnosticId)) {

            if (empty($symptomForSelect)) {
                alert('No se encontró ninguna enfermedad con los síntomas brindados, intente de nuevo', 'warning');
                return redirect()->route('user::diagnosticos::create');
            }

            // Listar los síntomas escogidos
            $tempSymptoms = Symptom::findOrFail($request->session()->get('session_sintomas'));
            foreach ($tempSymptoms as $tempSymptom) {
                $showSymptoms[$tempSymptom->id] = $tempSymptom->name;
            }

            return view('user.diagnostic.create')
                ->with('showSymptoms', $showSymptoms)
                ->with('sintomas', $symptomForSelect);
        }

        $request->session()->forget('session_sintomas');
        return redirect()
            ->route('user::diagnosticos::show', $this->encode($diagnosticId));
    }

    private function generateDiagnostic($diseaseKey, $userId)
    {
        $diagnostic             = new Diagnostic();
        $diagnostic->disease_id = $diseaseKey;
        $diagnostic->user_id    = $userId;
        $diagnostic->save();

        return $diagnostic->id;
    }

    public function delete_symptom($symptomId, Request $request)
    {
        if (!$request->session()->has('session_sintomas')) {
            abort(404);
        }

        $sessionSymptoms = $request->session()->get('session_sintomas');

        $key = array_search($symptomId, $sessionSymptoms);

        if ($key !== false) {
            unset($sessionSymptoms[$key]);
        } else {
            abort(404);
        }

        if (empty($sessionSymptoms)) {
            return redirect()->route('user::diagnosticos::create');
        }

        $request->session()->put(['session_sintomas' => $sessionSymptoms]);

        alert('Se eliminó el síntoma ingresado con éxito');
        return redirect()->back();
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
    /*
$enfermedades = Disease::whereSymptoms($request->sintomas)->get();

// sino hay enfermedad se redirige a una pagina diciendo que de nuevo
// proceda a ingresar los sintomas refinando su busqueda
if (empty($enfermedades)) {
alert('No se pudo encontrar un diagnóstico con los síntomas ingresados', 'danger');
return redirect()->route('user::diagnosticos::show');
}

$enfermedad = $enfermedades->filter(function ($enfermedad) use ($request) {

$numero_sintomas = count($request->sintomas);

foreach ($enfermedad->rules as $rule) {
$numero_sintomas--;
}

return ($numero_sintomas == 0) ? true : false;

})->first();

if (empty($enfermedad)) {
alert('No se pudo encontrar un diagnóstico con los síntomas ingresados', 'danger');
return redirect()->route('user::diagnosticos::show');
}

$diagnostico             = new Diagnostic();
$diagnostico->disease_id = $enfermedad->id;
$diagnostico->user_id    = $request->user()->id;
$diagnostico->save();
 */
}
