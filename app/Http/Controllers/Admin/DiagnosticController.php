<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\SearchRequest;
use Tesis\Models\Diagnostic;

class DiagnosticController extends Controller
{
    public function index()
    {
        $diagnostics = Diagnostic::with('disease', 'user')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.diagnostic.index')->with('diagnostics', $diagnostics);
    }

    public function search(SearchRequest $request)
    {
        if (!$request->has('search')) {
            return redirect()->route('admin::diagnosticos::index');
        }

        $diagnostics = Diagnostic::search($request->search)->with('disease', 'user')->get();

        return view('admin.diagnostic.result')->with('diagnostics', $diagnostics);
    }
}
