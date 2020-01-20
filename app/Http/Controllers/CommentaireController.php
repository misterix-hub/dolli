<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commentaire;

class CommentaireController extends Controller
{
    public function store(Request $request, $id, $post_id) {
        $commentaire = new Commentaire;
        $commentaire->publication_id = $id;
        $commentaire->user_id = session()->get('id');
        $commentaire->post_id = $post_id;
        $commentaire->texte = $request->texte;
        $commentaire->vu = 0;
        $commentaire->save();

        return back();
    }
}
