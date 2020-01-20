<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CodeEmail;
use App\User;

class UserController extends Controller
{
    public function registerForm(Request $request) {

        $code = rand(154789, 986899);
        
        $code_email = new CodeEmail;
        $code_email->email = $request->email;
        $code_email->code = $code;
        $code_email->save();

        session()->put('email', $request->email);

        return redirect(route('mail_sent'));
    }

    public function passwordForm(Request $request) {

        if ($request->password != $request->password_confirm) {
            return back()->with('error', "Les deux mot de passe ne sont pas identiques.");
        } else {
            session()->put('password', sha1($request->password));
            return redirect(route('nom_profession'));
        }
    }

    public function datasForm(Request $request) {
        session()->put('nom_complet', $request->nom_complet);
        session()->put('profession', $request->profession);

        $tab = [
            "a", "z", "e", "y", "u", "o", "p", "q", "g", "h", "l", "w", "x", "c",
            "T", "I", "S", "D", "F", "G", "J", "K", "L", "M", "N", "V", "B", "A",
            "?", "%", '$', "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Ç"
        ];

        $loop = true;
        $private = "";
        $public = "";

        while ($loop) {
            for ($i=0; $i < 26; $i++) { 
                $private .= $tab[rand(0, 41)];
                $public .= $tab[rand(0, 41)];
            }

            if (count(User::where('cle_privee', $private)->where('cle_publique')->get()) == 0) {
                $loop = false;
            }

        }

        if (!$loop) {

            session()->put('cle_privee', $private);
            session()->put('cle_publique', $public);
            
            $user = new User;
            $user->name = session()->get('nom_complet');
            $user->profession = session()->get('profession');
            $user->cle_privee = sha1($private);
            $user->cle_publique = $public;
            $user->solde = 3000;
            $user->avatar = "default.png";
            $user->couverture = "default.png";
            $user->email = session()->get('email');
            $user->password = session()->get('password');
            $user->save();

            session()->put('id',$user->id);
            session()->put('avatar',"default.png");

            /*setcookie('id', $user->id, time() + 365*24*3600, null, null, false, true);
            setcookie('nom_complet', session()->get('nom_complet'), time() + 365*24*3600, null, null, false, true);
            setcookie('profession', session()->get('profession'), time() + 365*24*3600, null, null, false, true);
            setcookie('email', session()->get('email'), time() + 365*24*3600, null, null, false, true);
            setcookie('avatar', "default.png", time() + 365*24*3600, null, null, false, true);*/
            
            return redirect(route('uKeys'));
        }
    }

    public function loginForm(Request $request) {
        $users = User::where('email', $request->email)->where('password', sha1($request->password))->get();

        if (count($users) == 0) {
            return back()->with('error', "Email ou mot de passe incorects !");
        } else {
            foreach ($users as $user) {
                session()->put('id', $user->id);
                session()->put('nom_complet', $user->name);
                session()->put('email', $user->email);
                session()->put('avatar', $user->avatar);
                session()->put('cle_privee', $user->cle_privee);
                session()->put('cle_publique', $user->cle_publique);
                session()->put('couverture', $user->couverture);
                session()->put('profession', $user->profession);
            }

            return redirect(route('uIndex'));
        }
    }

    public function solde(Request $request) {
        return view('ajaxView.users.solde', [
            'key' => $request->key
        ]);
    }

    public function destEnvoi(Request $request) {
        return view('ajaxView.users.dest_envoi', [
            'key' => $request->key,
            'montant' => $request->montant
        ]);
    }

    public function receptions($id) {
        return view('users.reception', [
            'id' => $id
        ]);
    }

    public function receptionForm(Request $request) {

        return view('ajaxView.users.receptionForm', [
            'key' => $request->key,
            'transaction' => $request->transaction,
        ]);
    }
}
