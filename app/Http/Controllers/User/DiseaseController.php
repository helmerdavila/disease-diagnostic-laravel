<?php

namespace Tesis\Http\Controllers\User;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Disease;

class DiseaseController extends Controller
{
    public function index()
    {
        $enfermedades = Disease::with('rules')->orderBy('name', 'asc')->paginate(10);

        return view('user.disease.index')
            ->with('enfermedades', $enfermedades);
    }
}
