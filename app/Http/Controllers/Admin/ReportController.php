<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;
use Tesis\Models\Disease;
use Tesis\Models\State;

class ReportController extends Controller
{
    public function index()
    {
        $diseases = Disease::lists('name', 'id')->toArray();
        $states   = State::lists('name', 'id')->toArray();

        return view('admin.reports.index')
            ->with('diseases', $diseases)
            ->with('states', $states);
    }
}
