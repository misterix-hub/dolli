@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-lg-6 col-md-12 col-sm-12">                 
                <div class="card font-size-14"> 
                    <div class="card-body">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                {{ $message }}
                            </div>
                        @endif
                        <form action="{{ route('publicationStore') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <a href="" class="float-right">
                                <small>
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    PLUS
                                </small>
                            </a>
                            <span class="text-muted">
                                <small>
                                    <i class="fas fa-globe-africa"></i>
                                    FAIRE UNE PUBLICATION
                                </small>
                            </span><br />

                            <textarea name="texte" id="texte"  rows="5" class="font-size-14 mt-3"
                            style="border: none; outline: none; border-bottom: 1px solid #CCC; width: 100%;"
                            rows="3" placeholder="Saisir la publication ici ..."></textarea>
                            <label for="image" class="text-muted">
                                <i class="fas fa-file-image text-warning"></i>
                                <small><b>Image ou photo</b></small>
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" style="width: 0; height: 0; outline: none;">

                            <button type="submit" style="background-color: #e66937;"
                            class="btn pl-3 pr-3 font-size-14 float-right text-light">
                                Partager
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card font-size-14"> 
                    <div class="card-body" style="text-align: justify;">
                        <b>Important</b><br />
                        Les publications faites par tous les utilisaterus y compris vous sont automatiquement
                        partagées et visibles par le public. Après publication, aucune modification ni suppression
                        n'est possible.
                    </div>
                </div><br />
                <div class="text-center">
                    <a href="{{ route('uIndex') }}" class="btn btn pl-3 pr-3 text-light font-size-14" style="background-color: #e66937;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Retour aux publications
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection