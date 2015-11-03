<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Diagnostic;

class DiagnosticController extends Controller
{
    public function index()
    {
        $diagnostics = Diagnostic::with('disease', 'user')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.diagnostic.index')->with('diagnostics', $diagnostics);
    }
}
