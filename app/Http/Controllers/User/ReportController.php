<?php

namespace Tesis\Http\Controllers\User;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;

class ReportController extends Controller
{
    public function user_diseases()
    {
        $data        = [];
        $diagnostics = Diagnostic::where('user_id', auth()->user()->id)->get();

        $groupDiagnostics = $diagnostics->groupBy('disease_id');

        $groupDiagnostics->each(function ($value, $key) use (&$data) {
            $disease = Disease::findOrFail($key);
            $data[]  = ['label' => $disease->name, 'value' => count($value)];
        });

        return response()->json($data);
    }
}
