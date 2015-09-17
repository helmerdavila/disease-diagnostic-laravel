<?php

namespace Tesis\Http\Controllers\User;

use Auth;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;

class HomeController extends Controller
{
    public function index()
    {
        $countDiagnostic = count(Auth::user()->diagnostics);
        $countDiseases = Disease::count();
        $countSymptom = Symptom::count();
        return view('user.home')
            ->with('countSymptom', $countSymptom)
            ->with('countDiseases', $countDiseases)
            ->with('countDiagnostic', $countDiagnostic);
    }
}
