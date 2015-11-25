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

        // Buscamos en la tabla de reglas con los síntomas obtenidos de la sesión primero buscando
        // por síntomas  y después buscando por número de regla
        $rules = Rule::with('symptom')->whereIn('symptom_id', $sessionSymptoms)->get()->groupBy('number');
        //dd($rules, $sessionSymptoms);
        list($rulesKeys, $value) = array_divide($rules->toArray());

        // Después buscamos en la tabla de reglas en base a número de su regla
        // obtenido en la anterior operación
        $rules = Rule::with('symptom')->whereIn('number', $rulesKeys)->get()->groupBy('number');

        //Agrupamos los interiores de las reglas en base al número de su síntoma
        $rules = $rules->map(function ($symptoms, $key) {
            return $symptoms->groupBy('symptom_id');
        });
        // Filtramos solo las reglas que contengan un número de síntomas igual a
        // los de la sesión o mayores y que los síntomas de la sesión estén
        // contenidos en cada una de las reglas.
        // Ej: [1,7,9] >= [1, 9] && [1,9] = [1,9]
        $rules = $rules->filter(function ($rule) use ($sessionSymptoms) {
            list($symptomKeys) = array_divide($rule->toArray());
            $intersect         = array_intersect($sessionSymptoms, $symptomKeys);

            if (($rule->count() >= count($sessionSymptoms)) && ($intersect == $sessionSymptoms)) {
                return true;
            }
        });
        //dd($rules, $sessionSymptoms);

        $symptomsForSelect = [];
        $diagnosticId      = 0;
        $maxSymptomKey     = 0;
        //dd($rules);
        foreach ($rules as $key => $ruleNumber) {

            list($symptomKeys) = array_divide($ruleNumber->toArray());

            $difference = array_diff($symptomKeys, $sessionSymptoms);

            // Contamos el arreglo de sintomas para saber cual es el que tendrá
            // más elementos y lo asignamos a la variable maxSymptomKey
            if (count($symptomKeys) > $maxSymptomKey) {
                $maxSymptomKey = count($symptomKeys);
            }

            //dd($difference, $symptomKeys);
            // Si esta vacío significa que no hay diferencias
            if (empty($difference)) {
                // tomamos el primer elemento del primer elemento de la coleccion
                // (está ordenado por id_sintoma)
                $diseaseKey   = $ruleNumber->first()->first()->disease_id;
                $diagnosticId = $this->generateDiagnostic($diseaseKey, $request->user()->id);
            } elseif ($symptomKeys == $difference) {
                alert('No se encontró ninguna enfermedad con los síntomas brindados, intente de nuevo', 'danger');
                return redirect()->route('user::diagnosticos::create');
            } else {
                $tempSymptoms = Symptom::findOrFail($difference);
                foreach ($tempSymptoms as $tempSymptom) {
                    $symptomsForSelect[$tempSymptom->id] = $tempSymptom->name;
                }
            }
        }

        if (empty($diagnosticId)) {

            // Si se acabaron los síntomas o si los síntomas en sesión son mayores
            // al mayor arreglo por regla entonces es porque la enfermedad es
            // indetectable con los síntomas ingresados.
            // Ej: Máxima Regla = [1, 3, 9, 10]
            // Ej: Síntoma en sesión = [1, 3, 4, 5, 9, 10, 13]
            $numberSessionSymtoms = count($request->session()->get('session_sintomas'));
            if (empty($symptomsForSelect) || ($numberSessionSymtoms > $maxSymptomKey)) {
                alert('No se encontró ninguna enfermedad con los síntomas brindados, intente de nuevo', 'danger');
                return redirect()->route('user::diagnosticos::create');
            }

            // Listar los síntomas escogidos
            $tempSymptoms = Symptom::findOrFail($request->session()->get('session_sintomas'));
            foreach ($tempSymptoms as $tempSymptom) {
                $showSymptoms[$tempSymptom->id] = $tempSymptom->name;
            }

            return view('user.diagnostic.create')
                ->with('showSymptoms', $showSymptoms)
                ->with('sintomas', $symptomsForSelect);
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
