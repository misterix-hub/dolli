<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\JaimePublication;
use App\Commentaire;

class PublicationController extends Controller
{
    public function store(Request $request) {
        if (trim($request->texte) == "" && trim($request->image) == "") {
            return back();
        } else {
            $publication = new Publication;
            $publication->user_id = session()->get('id');
            $publication->texte = $request->texte;

            if ($request->image != "") {

                $target_dir = "db/publication/";

                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if ($_FILES["image"]["size"] > 500000) {
                    return back()->with('error', "La taille de l'image est trop grande !");
                }

                if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
                    return back()->with('error', "Le type de l'image n'est pas autorisé !");
                }

                $target_file = $target_dir . session()->get('id') . time() . "." . $imageFileType;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $publication->image = $target_file;
                }

                
            }
            $publication->save();

            return redirect(route('uIndex'));
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

        if (count(Publication::where('id', $id)->get()) == 0) {
            abort('404');
        }
        if (!session()->has('id')) {
            return redirect(route('login'));
        }

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
