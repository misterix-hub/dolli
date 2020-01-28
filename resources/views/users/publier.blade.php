@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 68px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-lg-6 col-md-12 col-sm-12 font-size-14">   
                <div class="card">

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
                        <div class="card-header">
                            <span class="text-muted">
                                <small>
                                    <i class="fas fa-globe-africa"></i>
                                    FAIRE UNE PUBLICATION
                                </small>
                            </span>
                        </div>
                        <div class="card-body">
                            <textarea name="texte" minlength="2" maxlength="300" id="texte"  rows="5" class="font-size-14 form-control"
                                
                                rows="3" placeholder="Saisir la publication ici ..."></textarea>
                        </div>
                        <div class="card-footer text-muted">
                            <label for="image" class="text-muted">
                                <i class="fas fa-file-image text-warning"></i>
                                <small><b>Image ou photo</b></small>
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" style="width: 0; height: 0; outline: none;">

                            <button type="submit" style="background-color: #e66937;"
                            class="btn pl-3 pr-3 font-size-14 float-right text-light">
                                Partager
                            </button>
                        </div>
                    </form>
                </div>              
                <div class="card font-size-14"> 
                    <div class="card-body text-muted" style="text-align: justify;">
                        <b>Important</b><br />
                        Les publications faites par tous les utilisaterus y compris vous sont automatiquement
                        partagées et visibles par le public. Après publication, aucune modification ni suppression
                        n'est possible.
                    </div>
                </div><br />
                <div class="text-center">
                    <a href="{{ route('uIndex') }}" class="btn bg-gradient-secondary pl-4 pr-4 font-size-13">
                        Retour aux publications
                    </a>
                </div>
            </div>
        </div>
    </div><br />

@endsection