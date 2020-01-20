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
    return view('welcome');
})->name('login');

Route::get('register', function () {
    return view('register');
})->name('register');

Route::get('resets/password', function () {
    return view('forgot_password');
})->name('forgot_password');

Route::get('register/{code}/password', function ($code) {

    if (count(CodeEmail::where('email', session()->get('email'))->where('code', $code)->get()) == 0) {
        session()->put('code', $code);
        return redirect(route('register'));
    } else {
        return view('password');
    }
    
})->name('password');

Route::get('register/datas', function () {

    if(!session()->has('password')) {
        return redirect(route('register'));
    } else {
        $code_email = CodeEmail::where('email', session()->get('email'))->where('code', session()->get('code'));
        $code_email->delete();
        return view('nom_profession');
    }

})->name('nom_profession');

Route::get('users', function () {
    if (!session()->has('id')) {
        return redirect(route('login'));
    } else {
        return view('users.index');
    }

})->name('uIndex');

Route::get('register/keys', function () {
    if (!session()->has('nom_complet')) {
        return redirect(route('register'));
    } else {
        return view('users.cles');
    }
})->name('uKeys');

Route::get('register/mail_sent', function () {
    return view('mail_sent');
})->name('mail_sent');

Route::get('users/contacts', function() {
    return view('users.contacts');
})->name('uContacts');

Route::get('users/message/{id}', function($id) {

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


Route::get('logout', function () {
    session()->forget('id');
    session()->forget('email');
    session()->forget('cle_privee');
    session()->forget('cle_publique');
    session()->forget('avatar');
    session()->forget('couverture');
    session()->forget('nom_complet');
    session()->forget('profession');
    session()->forget('password');

    return redirect(route('login'));
})->name('logout');