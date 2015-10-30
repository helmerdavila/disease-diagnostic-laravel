<?php

namespace Tesis\Http\Controllers\Admin;

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
}
