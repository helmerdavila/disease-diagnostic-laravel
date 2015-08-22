<?php

namespace Tesis\Http\Controllers\Admin;

use Tesis\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        return view('admin.home');
    }
}
