<?php

namespace Tesis\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Tesis\Http\Controllers\Controller;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/user/inicio';

    public function __construct()
    {
        $this->middleware('guest');
    }
}
