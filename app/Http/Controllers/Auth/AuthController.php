<?php

namespace Tesis\Http\Controllers\Auth;

use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\AuthRequest;
use Tesis\Http\Requests\RegisterRequest;
use Tesis\Models\State;
use Tesis\Models\User;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $loginPath = '/';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('auth', ['only' => 'getLogout']);
    }

    public function showLogin()
    {
        return view('login');
    }

    /**
     * Inicio de sesión para el usuario, dependiendo de su rol es dirigido
     * a su panel de administración respectivo
     */
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

    public function showRegister()
    {
        $states = State::lists('name', 'id')->toArray();

        return view('register')->with('states', $states);
    }

    /**
     * Creamos el usuario a través del registro y le asignamos el rol de usuario
     */
    public function showRegisterPost(RegisterRequest $request)
    {
        $form = collect_clean($request->all());

        $request['password'] = bcrypt($request->password);

        $user = User::create($form->toArray());
        $user->attachRole(2);

        alert('Cuenta creada correctamente, puede iniciar sesión');
        return redirect()->route('showLogin');
    }
}
