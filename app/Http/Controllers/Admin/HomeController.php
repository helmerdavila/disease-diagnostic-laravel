<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;

class HomeController extends Controller
{
    public function home()
    {
        $countDiseases = Disease::count();
        $countSymptom = Symptom::count();
        $countDiagnostic = Diagnostic::count();

        return view('admin.home')
            ->with('countDiagnostic', $countDiagnostic)
            ->with('countSymptom', $countSymptom)
            ->with('countDiseases', $countDiseases);
    }
}
