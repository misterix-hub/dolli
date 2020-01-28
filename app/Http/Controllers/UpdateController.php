<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UpdateController extends Controller
{
    public function name(Request $request) {

        $user = User::find(session()->get('id'));
        $user->name = $request->nom_complet;
        $user->profession = $request->profession;
        $user->save();

        session()->put('nom_complet', $request->nom_complet);
        session()->put('profession', $request->profession);

        return redirect(route('uCompte'));
    }
}
