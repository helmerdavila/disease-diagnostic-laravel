<?php

namespace Tesis\Http\Controllers\Admin;

use Carbon\Carbon;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;
use Tesis\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $countDiseases   = Disease::count();
        $countSymptom    = Symptom::count();
        $countDiagnostic = Diagnostic::count();
        $lastRegistered  = User::orderBy('created_at', 'desc')->take(9)->get();

        return view('admin.home')
            ->with('countDiagnostic', $countDiagnostic)
            ->with('countSymptom', $countSymptom)
            ->with('countDiseases', $countDiseases)
            ->with('lastRegistered', $lastRegistered);
    }

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
                $newDate = $today->copy()->subMonth($keyMonth);
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
}
