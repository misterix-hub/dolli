<?php

use App\CodeEmail;
use App\Contact;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }
    return view('welcome');
})->name('login');

Route::get('register', function () {
    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }
    return view('register');
})->name('register');

Route::get('resets/password', function () {
    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }
    return view('forgot_password');
})->name('forgot_password');

Route::get('register/{code}/password', function ($code) {

    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }

    if (count(CodeEmail::where('email', session()->get('email'))->where('code', $code)->get()) == 0) {
        return redirect(route('register'));
    } else {
        session()->put('code', $code);
        return view('password');
    }
    
})->name('password');

Route::get('register/datas', function () {

    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }

    if(!session()->has('password')) {
        return redirect(route('register'));
    } else {
        Illuminate\Support\Facades\DB::delete("DELETE FROM code_emails WHERE email = ? AND code = ?", [
            session()->get('email'), session()->get('code')
        ]);
        return view('nom_profession');
    }

})->name('nom_profession');

Route::get('users', function () {

    session()->forget('cle_privee');
    session()->forget('cle_publique');

    if (!session()->has('id')) {
        return redirect(route('login'));
    } else {
        return view('users.index');
    }

})->name('uIndex');

Route::get('register/keys', function () {
    if (!session()->has('cle_privee') || !session()->has('cle_publique')) {
        return redirect(route('register'));
    }

    if (!session()->has('nom_complet')) {
        return redirect(route('register'));
    } else {
        return view('users.cles');
    }
})->name('uKeys');

Route::get('register/mail_sent', function () {
    if (session()->has('id')) {
        return redirect(route('uIndex'));
    }
    if (!session()->has('email')) {
        return redirect(route('login'));
    }
    return view('mail_sent');
})->name('mail_sent');

Route::get('users/contacts', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    return view('users.contacts');
})->name('uContacts');

Route::get('users/message/{id}', function($id) {

    if (!session()->has('id')) {
        return redirect(route('login'));
    }

    if (count(App\User::where('id', $id)->get()) == 0) {
        abort('404');
    }

    if (session()->get('id') != $id) {
        $contacts = Illuminate\Support\Facades\DB::select('SELECT * FROM contacts
        WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)', [
            session()->get('id'), $id, $id, session()->get('id')
        ]);

        if (count($contacts) == 0) {
            $contact = new Contact;
            $contact->user1_id = session()->get('id');
            $contact->user2_id = $id;
            $contact->save();
        } else {
            Illuminate\Support\Facades\DB::delete('DELETE FROM contacts
            WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)', [
                session()->get('id'), $id, $id, session()->get('id')
            ]);

            $contact = new Contact;
            $contact->user1_id = session()->get('id');
            $contact->user2_id = $id;
            $contact->save();
        }   
    }

    return view('users.message', [
        'id' => $id
    ]);
})->name('uMessage');

Route::get('users/publier', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    return view('users.publier');
})->name('uPublier');

Route::get('users/messages/discussion/box', 'MessageController@discussion')->name('getMessagesBox');

Route::get('users/messages/store/ajax', 'MessageController@store')->name('uStoreMessage');
Route::get('users/messages/liste', 'MessageController@body')->name('getMessages');

Route::post('register', 'UserController@registerForm')->name('registerForm');
Route::post('register/password', 'UserController@passwordForm')->name('passwordForm');
Route::post('register/datas', 'UserController@datasForm')->name('datasForm');
Route::get('users/solde', 'UserController@solde')->name('getSolde');

Route::post('login', 'UserController@loginForm')->name('loginForm');
Route::get('users/envoi/dest', 'UserController@destEnvoi')->name('destEnvoi');
Route::get('users/notifications', 'NotificationController@nbNotification')->name('nbNotification');
Route::get('users/notifications/recup', 'NotificationController@recupNotification')->name('recupNotification');
Route::get('users/{id}/receptions', 'UserController@receptions')->name('receptions');
Route::get('users/receptions/form', 'UserController@receptionForm')->name('receptionForm');
Route::post('users/publications/post', 'PublicationController@store')->name('publicationStore');

Route::get('users/publications/{id}/jaime', 'PublicationController@jaime')->name('jaimePublication');
Route::post('users/publications/{id}/comments/{post_id}/', 'CommentaireController@store')->name('storeComment');
Route::get('users/publications/{id}/comments', 'PublicationController@details')->name('publication');

Route::get('users/messages/notifcations/list', 'MessageController@notifications')->name('messagesNotifications');
Route::get('users/messages/notifcations/list/nombres', 'MessageController@nbMessages')->name('nbMessageNotification');

Route::get('users/settings/avatar', 'UserController@photo_profil')->name('photoProfil');
Route::get('users/settings/avatar/success', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    if (session()->get('avatar') == "default.png") {
        session()->put('avatar', session()->get('id') . ".png");
        $user = App\User::find(session()->get('id'));
        $user->avatar = session()->get('id') . ".png";
        $user->save();
    }

    return redirect(route('photoProfil'));
})->name('successAvatar');

Route::get('users/settings/cover/success', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    if (session()->get('couverture') == "default.png") {
        session()->put('couverture', session()->get('id') . ".png");
        $user = App\User::find(session()->get('id'));
        $user->couverture = session()->get('id') . ".png";
        $user->save();
    }

    return redirect(route('photoProfil'));
})->name('successCover');


Route::get('logout', function () {
    session()->forget('id');
    session()->forget('email');
    session()->forget('code');
    session()->forget('avatar');
    session()->forget('couverture');
    session()->forget('nom_complet');
    session()->forget('profession');
    session()->forget('password');

    return redirect(route('login'));
})->name('logout');

Route::get('users/messages/all', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    return view('users.all_messages');
})->name('allMessages');

Route::get('users/notifications/all', function() {
    if (!session()->has('id')) {
        return redirect(route('login'));
    }
    return view('users.all_notifications');
})->name('allNotifications');

Route::get('users/{id}/profile', 'UserController@profil')->name('uProfil');
Route::get('users/account/details', 'UserController@compte')->name('uCompte');
Route::post('users/update/name', 'UpdateController@name')->name('updateName');
Route::get('users/search/users', 'UserController@search')->name('result_search');