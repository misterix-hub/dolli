<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\JaimePublication;
use App\Commentaire;

class PublicationController extends Controller
{
    public function store(Request $request) {
        if (trim($request->text) == "" && trim($request->image)) {
            return back();
        } else {
            $publication = new Publication;
            $publication->user_id = session()->get('id');
            $publication->texte = $request->texte;
            $publication->image = $request->image;
            $publication->save();

            return back();
        }

    }

    public function jaime($id) {
        if (count(JaimePublication::where('publication_id', $id)->where('user_id', session()->get('id'))->get()) == 0) {
            $jaime_publication = new JaimePublication;
            $jaime_publication->user_id = session()->get('id');
            $jaime_publication->publication_id = $id;
            $jaime_publication->save();
        }
        return back();
        
    }

    public function details($id) {

        foreach (Commentaire::where('publication_id', $id)->get() as $commentaire) {
            $commentaire = Commentaire::find($commentaire->id);
            $commentaire->vu = 1;
            $commentaire->save();
        }


        return view('users.publication', [
            'id' => $id
        ]);
    }
}
