<?php

namespace Tesis\Http\Controllers\Admin;

use Carbon\Carbon;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\UserRequest;
use Tesis\Models\User;
use Tesis\Traits\HashTrait;

class UserController extends Controller
{
    use HashTrait;

    public function create()
    {
        $usuarios = User::orderBy('created_at', 'desc')->with('diagnostics')->paginate(20);

        return view('admin.user.index')->with('usuarios', $usuarios);
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

        $usuario = User::findOrFail($id);

        return view('admin.user.edit')->with('usuario', $usuario);
    }

    public function update($hash_id, UserRequest $request)
    {
        $id = $this->decode($hash_id);

        if ($request->has('birthday')) {
            $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        $usuario = User::findOrFail($id);

        $usuario->update($request->all());

        alert('Se modificó el usuario correctamente');
        return redirect()->route('admin::usuarios::create');
    }
}
