<?php

namespace Tesis\Http\Controllers\Admin;

use Carbon\Carbon;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\UserRequest;
use Tesis\Models\User;
use Vinkla\Hashids\HashidsManager;

class UserController extends Controller
{
    protected $hashids;

    public function __construct(HashidsManager $hashids)
    {
        $this->middleware('auth');
        $this->hashids = $hashids;
    }

    public function index()
    {

    }

    public function create()
    {
        $usuarios = User::orderBy('created_at', 'desc')->with('diagnostics')->paginate(20);

        return view('admin.user.index')->with('usuarios', $usuarios);
    }

    public function store(UserRequest $request)
    {
        if ($request->has('birthday')) {
            $request['birthday'] = Carbon::createFromFormat('d/m/Y', $request->input('birthday'))->format('Y-m-d');
        }

        if (User::create($request->all())) {
            alert('Usuario registrado correctamente', 'success');
        } else {
            alert('Hubo un problema al registrar por favor intente nuevamente');
        }

        return redirect()->back();
    }

    public function edit($encrypt_id)
    {
        if (!empty($this->hashids->decode($encrypt_id))) {
            $decoded = $this->hashids->decode($encrypt_id);
            if ($usuario = User::find($decoded[0])) {
                return view('admin.user.edit')->with('usuario', $usuario);
            }
        }
        return abort(404);
    }

    public function update($encrypt_id, UserRequest $request)
    {
        if ($usuario = User::find($id)) {

            if ($usuario->update($request->all())) {
                alert('Se modificó el usuario correctamente', 'success');
            } else {
                alert('Hubo un problema al modificar, por favor intente nuevamente');
            }
            return redirect()->route('getListarUsuario');
        }

        return abort(404);
    }
}
