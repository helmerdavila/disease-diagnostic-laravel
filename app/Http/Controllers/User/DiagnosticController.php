<?php

namespace Tesis\Http\Controllers\User;

use Illuminate\Http\Request;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\Disease;
use Tesis\Models\Symptom;

class DiagnosticController extends Controller
{
    public function index()
    {
        $sintomas = Symptom::orderBy('name', 'asc')->lists('name', 'id')->toArray();

        return view('user.diagnostic.index')->with('sintomas', $sintomas);
    }

    public function analyze(Request $request)
    {
        $this->validate($request, ['sintomas' => 'required|min:3']);

        $enfermedad = Disease::whereHas('rules', function ($query) use ($request) {
            $query->whereIn('symptom_id', $request['sintomas']);
        })->get();

        dd($enfermedad);
    }
}
