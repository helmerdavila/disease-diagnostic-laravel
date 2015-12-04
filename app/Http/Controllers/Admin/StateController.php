<?php

namespace Tesis\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Tesis\Http\Controllers\Controller;
use Tesis\Models\State;
use Tesis\Traits\HashTrait;

class StateController extends Controller
{
    use HashTrait;

    public function create()
    {
        $states = State::with('users')->orderBy('name', 'asc')->get();

        return view('admin.state.index')->withStates($states);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $state = State::create($request->only('name'));

        alert(trans('messages.state.created'));
        return redirect()->back();
    }

    public function edit($id)
    {
        $state = State::findOrFail($this->decode($id));

        return view('admin.state.edit')->withState($state);
    }

    public function update($id, Request $request)
    {
        $state = State::findOrFail($this->decode($id));

        $state->update($request->only('name'));

        alert(trans('messages.state.updated'));
        return redirect()->route('admin::states::create');
    }

    public function delete($id)
    {
        $state = State::findOrFail($this->decode($id));

        if ($state->users->count() > 0) {
            alert(trans('messages.state.not_deleted'), 'danger');
            return redirect()->back();
        }

        $state->delete();

        alert(trans('messages.state.deleted'));
        return redirect()->back();
    }
}
