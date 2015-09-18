<?php

namespace Tesis\Http\Controllers\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\AuthRequest;
use Tesis\User;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $loginPath = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('auth', ['only' => 'getLogout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users.email',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showLogin()
    {
        return view('login');
    }

    public function showLoginPost(AuthRequest $request)
    {
        if (!$request->isMethod('post')) {
            return redirect()->back();
        }

        $remember = intval($request->input('remember', 0));

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            if (Auth::user()->hasRole('usuario')) {
                return redirect()->intended(route('user::home'));
            }
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin::home'));
            }
        }

        alert('Correo y/o contraseña inválidos', 'danger');
        return redirect()->back();
    }
}
