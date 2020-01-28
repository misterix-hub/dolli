<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CodeEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Transaction;

class UserController extends Controller
{
    public function search(Request $request) {

        if (!session()->has('id')) {
            return redirect(route('login'));
        }

        return view('users.result_search', [
            "query" => $request->search_q
        ]);
    }

    public function registerForm(Request $request) {

        if (session()->has('id')) {
            return redirect(route('uIndex'));
        }

        if (strlen($request->email) < 10) {
            return back()->with('error', "Email trop court !");
        }

        if (strlen($request->email) > 50) {
            return back()->with('error', "Email trop long !");
        }

        if (count(User::where('email', $request->email)->get()) != 0) {
            return back()->with('error', "Email déjà utilisé !");
        } else {
            $code = rand(154789, 986899);
            
            $code_email = new CodeEmail;
            $code_email->email = $request->email;
            $code_email->code = $code;
            $code_email->save();
    
            session()->put('email', $request->email);
    
            /*$to_name = "Dolli";
    
            $to_email = $request->email;
            $data = array(
                'nom' => $request->email,
                'code' => $code
            );
    
            Mail::send('mails.code_password', $data, function ($message) use ($to_name, $to_email) {
                $message->to($to_email)
                ->subject("Confirmation email");
            });*/
    
            return redirect(route('mail_sent'));
        }
        

    }

    public function passwordForm(Request $request) {

        if (session()->has('id')) {
            return redirect(route('uIndex'));
        }

        if ($request->password != $request->password_confirm) {
            return back()->with('error', "Les deux mot de passe ne sont pas identiques.");
        } else {
            if (strlen($request->password) < 6) {
                return back()->with('error', "Mot de passe trop court !");
            } elseif (strlen($request->password) > 20) {
                return back()->with('error', "Mot de passe trop long. 20 catactères max !");
            } else {
                session()->put('password', $request->password);
                return redirect(route('nom_profession'));
            }
        }
    }

    public function datasForm(Request $request) {

        if (strlen($request->nom_complet) < 3) {
            return back()->with('error', "Nom complet trop cout !");
        }

        if (strlen($request->nom_complet) > 25) {
            return back()->with('error', "Mot complet trop long. 25 catactères max !");
        }

        if (strlen($request->nom_complet) < 5) {
            return back()->with('error', "Texte trop cout !");
        }

        if (strlen($request->nom_complet) > 300) {
            return back()->with('error', "Texte trop long. 300 catactères max !");
        }

        if (session()->has('id')) {
            return redirect(route('uIndex'));
        }

        session()->put('nom_complet', $request->nom_complet);

        $tab = [
            "a", "z", "e", "y", "u", "o", "p", "q", "g", "h", "l", "w", "x", "c",
            "T", "I", "S", "D", "F", "G", "J", "K", "L", "M", "N", "V", "B", "A",
            "?", "%", '$', "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Ç"
        ];

        $loop = true;
        $private = "";
        $public = "";

        for ($i=0; $i < 26; $i++) { 
            $private .= $tab[rand(0, 41)];
            $public .= $tab[rand(0, 41)];
        }


        session()->put('cle_privee', $private . count(User::all()));
        session()->put('cle_publique', $public . count(User::all()));
        
        $user = new User;
        $user->name = session()->get('nom_complet');
        $user->profession = $request->profession;
        $user->cle_privee = bcrypt(session()->get('cle_privee'));
        $user->cle_publique = bcrypt(session()->get('cle_publique'));
        $user->solde = 3000;
        $user->avatar = "default.png";
        $user->couverture = "default.png";
        $user->email = session()->get('email');
        $user->password = bcrypt(session()->get('password'));
        $user->save();

        session()->put('id',$user->id);
        session()->put('avatar',"default.png");
        session()->put('couverture',"default.png");
        session()->put('profession', $request->profession);

        return redirect(route('uKeys'));
    }

    public function loginForm(Request $request) {

        $users = User::where('email', $request->email)->get();

        if (count($users) == 0) {
            return back()->with('error', "Email incorect !");
        } else {
            foreach ($users as $user) {

                if (\Hash::check($request->password, $user->password)) {
                    session()->put('id', $user->id);
                    session()->put('nom_complet', $user->name);
                    session()->put('email', $user->email);
                    session()->put('avatar', $user->avatar);
                    session()->put('cle_privee', $user->cle_privee);
                    session()->put('cle_publique', $user->cle_publique);
                    session()->put('couverture', $user->couverture);
                    session()->put('profession', $user->profession);
                } else {
                    return back()->with('error', "Mot de passe incorrect !");
                }
            }

            return redirect(route('uIndex'));
        }
    }

    public function solde(Request $request) {

        if (!session()->has('id')) {
            return redirect(route('login'));
        }

        return view('ajaxView.users.solde', [
            'key' => $request->key
        ]);
    }

    public function destEnvoi(Request $request) {

        if (!session()->has('id')) {
            return redirect(route('login'));
        }

        return view('ajaxView.users.dest_envoi', [
            'key' => $request->key,
            'montant' => $request->montant
        ]);
    }

    public function receptions($id) {
        if (count(Transaction::where('id', $id)->get()) == 0) {
            abort('404');
        }
        if (!session()->has('id')) {
            return redirect(route('login'));
        }
        return view('users.reception', [
            'id' => $id
        ]);
    }

    public function receptionForm(Request $request) {

        if (!session()->has('id')) {
            return redirect(route('login'));
        }

        return view('ajaxView.users.receptionForm', [
            'key' => $request->key,
            'transaction' => $request->transaction,
        ]);
    }

    public function photo_profil() {
        if (!session()->has('id')) {
            return redirect(route('login'));
        }
        return view('users.photo_profil');
    }

    public function profil($id) {
        if (!session()->has('id')) {
            return redirect(route('login'));
        }
        if (count(User::where('id', $id)->get()) == 0) {
            abort('404');
        }
        return view('users.profil', [
            'id' => $id
        ]);
    }

    public function compte() {
        if (!session()->has('id')) {
            return redirect(route('login'));
        }
        return view('users.compte');
    }
}
