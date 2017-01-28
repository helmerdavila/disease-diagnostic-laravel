<?php

namespace Tesis\Http\Controllers\Admin;

use Carbon\Carbon;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;
use Tesis\Models\State;
use Tesis\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        $diseases        = Disease::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $states          = State::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $countDiagnostic = Diagnostic::count();

        return view('admin.reports.index')
            ->with('countDiagnostic', $countDiagnostic)
            ->with('diseases', $diseases)
            ->with('states', $states);
    }

    /**
     * Funciones usadas por Ajax
     */
    public function all_diseases()
    {
        $diseases = Disease::with('diagnostics')->get();
        $data     = [];

        foreach ($diseases as $disease) {
            $data[] = ['label' => $disease->name, 'value' => $disease->diagnostics->count()];
        }

        return response()->json($data);
    }

    public function top_two_diagnostic()
    {
        $diseases = Disease::with('diagnostics')->get();
        $names    = [];

        // ordenando de acuerdo a los diagnosticos que posee
        $diseases = $diseases->sortByDesc(function ($disease) {
            return $disease->diagnostics->count();
        });

        // tomamos los 2 primeros
        $diseases = $diseases->take(2);

        $diseases->each(function ($disease) use (&$names) {
            $names[] = $disease->name;
        });

        $months = array_months();

        $today   = Carbon::create(null, null, 1);
        $newDate = $today->copy();

        // Por cada mes mostramos cuantos diagnosticos se realizaron
        foreach ($months as $keyMonth => $value) {

            if ($keyMonth != 1) {
                $newDate->subDay();
                $newDate->startOfMonth();
            }

            // inicializamos a 0 por cada indice de diseases, no por el Id
            foreach ($diseases as $keyDisease => $disease) {
                $aux[$keyDisease] = 0;
            }

            foreach ($diseases as $keyDisease => $disease) {
                foreach ($disease->diagnostics as $diagnostic) {
                    if ($diagnostic->created_at->month == $newDate->month && $diagnostic->created_at->year == $newDate->year) {
                        $aux[$keyDisease]++;
                    }
                }
            }

            $result[] = [
                'month'  => $value,
                'first'  => $aux[0],
                'second' => $aux[1],
            ];
        }

        return response()->json([
            'names'  => $names,
            'result' => $result,
        ]);
    }

    public function diagnostics_by_state()
    {
        $states = State::with('diagnostics')->get();
        $data   = [];

        foreach ($states as $state) {
            $data[] = ['label' => $state->name, 'value' => $state->diagnostics->count()];
        }

        return response()->json($data);
    }

    public function users_by_state()
    {
        $states = State::with('users')->get();
        $data   = [];

        foreach ($states as $state) {
            $data[] = ['label' => $state->name, 'value' => $state->users->count()];
        }

        return response()->json($data);
    }

    public function top_users_diagnostics()
    {
        $users = User::with('diagnostics')->get();

        $users = $users->sortByDesc(function ($user) {
            return $user->diagnostics->count();
        });

        $users = $users->take(5);

        foreach ($users as $user) {
            $data[] = ['label' => "{$user->name} {$user->lastname}", 'value' => $user->diagnostics->count()];
        }

        return response()->json($data);
    }

    public function top_diseases_diagnostics()
    {
        $diseases = Disease::with('diagnostics')->get();

        $diseases = $diseases->sortByDesc(function ($disease) {
            return $disease->diagnostics->count();
        });

        $diseases = $diseases->take(5);

        foreach ($diseases as $disease) {
            $data[] = ['label' => $disease->name, 'value' => $disease->diagnostics->count()];
        }

        return response()->json($data);
    }

    public function anual_disease_diagnostics($disease_id)
    {
        $disease = Disease::with('diagnostics')->findOrFail($disease_id);

        $months = array_months();

        $today   = Carbon::create(null, null, 1);
        $newDate = $today->copy();

        // Por cada mes mostramos cuantos diagnosticos se realizaron
        foreach ($months as $keyMonth => $value) {

            if ($keyMonth != 1) {
                $newDate->subDay();
                $newDate->startOfMonth();
            }

            $aux = 0;

            foreach ($disease->diagnostics as $diagnostic) {
                if ($diagnostic->created_at->month == $newDate->month && $diagnostic->created_at->year == $newDate->year) {
                    $aux++;
                }
            }

            $result[] = [
                'month' => $value,
                'first' => $aux,
            ];
        }

        return response()->json([
            'names'  => [$disease->name],
            'result' => $result,
        ]);
    }

    /**
     * Función que calcula la evolución de diagnósticos por enfermedad, anualmente
     * se usa -1 porque Morris toma valores desde un array con index 0
     */
    public function anual_state_diagnostics($state_id)
    {
        $names    = $indexs    = [];
        $diseases = Disease::all();

        $diagnostics = Diagnostic::whereHas('user', function ($query) use ($state_id) {
            $query->where('state_id', $state_id);
        })->with('user')->get();

        // llenamos un arreglo de indices y otro de nombres para la grafica
        $diseases->each(function ($disease) use (&$names, &$indexs) {
            $indexs[]                  = ($disease->id) - 1;
            $names[($disease->id) - 1] = $disease->name;
        });

        $months = array_months();

        $today   = Carbon::create(null, null, 1);
        $newDate = $today->copy();

        // Por cada mes mostramos cuantos diagnosticos se realizaron
        foreach ($months as $keyMonth => $value) {

            if ($keyMonth != 1) {
                $newDate->subDay();
                $newDate->startOfMonth();
            }

            foreach ($diseases as $disease) {
                $aux[($disease->id) - 1] = 0;
            }

            foreach ($diagnostics as $diagnostic) {
                if ($diagnostic->created_at->month == $newDate->month && $diagnostic->created_at->year == $newDate->year) {
                    $aux[($diagnostic->disease_id) - 1]++;
                }
            }

            $arrayMonth = ['month' => $value];
            // aca no se utiliza merge, para que no reindexe la union de arrays
            $result[] = $arrayMonth + $aux;
        }

        return response()->json([
            'names'  => $names,
            'indexs' => $indexs,
            'result' => $result,
        ]);
    }
}
