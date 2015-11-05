<?php

namespace Tesis\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Tesis\Http\Controllers\Controller;
use Tesis\Http\Requests\PasswordRequest;
use Tesis\Http\Requests\ProfileRequest;
use Tesis\Models\Diagnostic;
use Tesis\Models\Disease;
use Tesis\Models\State;
use Tesis\Models\Symptom;
use Tesis\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        $countDiseases   = Disease::count();
        $countSymptom    = Symptom::count();
        $countDiagnostic = Diagnostic::count();
        $lastRegistered  = User::orderBy('created_at', 'desc')->take(9)->get();

        return view('admin.home')
            ->with('countDiagnostic', $countDiagnostic)
            ->with('countSymptom', $countSymptom)
            ->with('countDiseases', $countDiseases)
            ->with('lastRegistered', $lastRegistered);
    }

    public function profile()
    {
        $states = State::orderBy('name', 'asc')->lists('name', 'id')->toArray();

        return view('admin.profile')->with('states', $states);
    }

    public function profile_update(ProfileRequest $request)
    {
        // Comprobar si el email existe solo si se ha cambiado el email
        if ($request->email != auth()->user()->email) {
            $user = User::whereEmail($request->email)->get();
            if (!empty($user)) {
                alert('El email ingresado ya existe', 'danger');
                return redirect()->back();
            }
        }

        $state = State::findOrFail($request->state);

        $user = auth()->user();
        $user->state()->associate($state);
        $user->update($request->all());

        alert('Se modificaron los datos con éxito');
        return redirect()->back();
    }

    public function password_update(PasswordRequest $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            alert('La contraseña ingresada no coincide con la actual', 'danger');
            return redirect()->back();
        }

        $user           = auth()->user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        alert('Se cambió la contraseña con éxito');
        return redirect()->back();
    }
}
