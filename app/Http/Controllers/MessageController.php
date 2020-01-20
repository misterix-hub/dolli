<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
//use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function store(Request $request) {
        $message = new Message;
        $message->user_id = session()->get('id');
        $message->dest_id = $request->dest_id;
        $message->texte = $request->texte;
        $message->lu = 0;
        $message->save();
    }

    public function body(Request $request) {

        foreach (Message::where('dest_id', session()->get('id'))->where('user_id', $request->user_id)->get() as $message_lu) {
            $message = Message::find($message_lu->id);
            $message->lu = 1;
            $message->save();
        }
        
        return view("ajaxView.users.messages.body", [
            'dest_id' => $request->user_id
        ]);
    }

    public function discussion() {
        return view('ajaxView.users.messages.discussion');
    }

    public function notifications() {
        return view('ajaxView.users.messages');
    }
}
