<?php

namespace Tesis\Http\Controllers\Admin;

use Carbon\Carbon;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\UserRequest;
use Tesis\Models\State;
use Tesis\Models\User;
use Tesis\Traits\HashTrait;

class UserController extends Controller
{
    use HashTrait;

    public function create()
    {
        $states   = State::lists('name', 'id')->toArray();
        $usuarios = User::with('state', 'diagnostics')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.user.index')
            ->with('states', $states)
            ->with('usuarios', $usuarios);
    }

    public function store(UserRequest $request)
    {
        if ($request->has('birthday')) {
            $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        User::create($request->all());

        alert('Usuario registrado correctamente');
        return redirect()->back();
    }

    public function edit($hash_id)
    {
        $id = $this->decode($hash_id);

        $states  = State::lists('name', 'id')->toArray();
        $usuario = User::findOrFail($id);

        return view('admin.user.edit')
            ->with('states', $states)
            ->with('usuario', $usuario);
    }

    public function update($hash_id, UserRequest $request)
    {
        $id = $this->decode($hash_id);

        if ($request->has('birthday')) {
            $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        $usuario = User::findOrFail($id);

        $usuario->update($request->all());

        // actualizando departamento
        if ($request->has('state')) {
            if ($request->state != $usuario->state_id) {
                $state = State::findOrFail($request->state);
                $usuario->state()->associate($state);
                $usuario->save();
            }
        }

        alert('Se modificó el usuario correctamente');
        return redirect()->route('admin::usuarios::create');
    }
}
