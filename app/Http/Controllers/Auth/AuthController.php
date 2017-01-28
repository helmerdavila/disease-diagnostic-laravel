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

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('auth', ['only' => 'getLogout']);
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

        // Throttles Logins
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $remember = intval($request->input('remember', 0));

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            if (Auth::user()->hasRole('paciente')) {
                return redirect()->intended(route('user::home'));
            }
            if (Auth::user()->hasRole('admin')) {
                return redirect()->intended(route('admin::home'));
            }
        }

        alert(trans('auth.failed'), 'danger');
        return redirect()->back();
    }

    public function showRegister()
    {
        $states = State::lists('name', 'id')->toArray();

        return view('register')->with('states', $states);
    }

    public function showRegisterPost(RegisterRequest $request)
    {
        $form = collect_clean($request->all());

        $request['password'] = bcrypt($request->password);

        $user = User::create($form->toArray());
        $user->attachRole(2);

        alert(trans('messages.register.successful'));
        return redirect()->route('showLogin');
    }
}
