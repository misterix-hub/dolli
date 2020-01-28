@extends('layouts.header')

@section('content')

    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            
            <div class="col-md-4 col-sm-12 font-size-13">

                @foreach (App\User::where('id', session()->get('id'))->get() as $user)
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <div class="widget-user-header text-white">
                                <img src="{{ URL::asset('db/covers/' . $user->couverture) }}" alt="" width="100%">
                                <div style="position: absolute; top: 5px; right: 0; left: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.3);">
                                    <h3 class="widget-user-username text-right pt-3 pr-2" style="font-family: jura;">{{ $user->name }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            
                            <div class="widget-user-image text-center" style="margin-top: -80px;">
                                <a href="#!">
                                    <img class="img-circle" width="100" src="{{ URL::asset('db/avatar/'.$user->avatar) }}" 
                                    style="border: 2px solid #FFF; position: relative;" alt="User Avatar">
                                </a>
                            </div>

                            <br />

                            <b>Email</b> : {{ $user->email }}<hr />

                            <form action="{{ route('updateName') }}" method="post">
                                @csrf
                                <b>Plus sur {{ substr($user->name, 0, strpos($user->name, " ")) }}</b> : <br />
                                <label for="profession" class="mt-2 mb-1"><small>Cliquez ici pour modifier</small></label><br />
                                <input type="text" value="{{ $user->profession }}" id="profession" name="profession" required
                                style="width: 100%; border: none; outline: none; border-bottom: 1px solid #CCC;">

                                <br /><br />
                                <b>Nom complet</b> : <br />
                                <label for="nom_complet" class="mt-2 mb-1"><small>Cliquez ici pour modifier</small></label><br />
                                <input type="text" value="{{ $user->name }}" id="nom_complet" name="nom_complet" required
                                style="width: 100%; border: none; outline: none; border-bottom: 1px solid #CCC;">
                                
                                <button type="submit" class="btn btn-default btn-block mt-3 font-size-14">
                                    <b>Mettre à jour</b>
                                </button>
                            </form>
                      
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-md-1 col-sm-12"></div>
            <div class="col-md-3 col-sm-12 font-size-13">

                <div class="text-center">
                    <b>CHANGER MON EMAIL (<small>En cours de développement ...</small>)</b>
                </div><br />

                <form action="" method="post">
                    @csrf

                    <label for="ol_password" class="mt-2">Nouvelle adresse email</label>
                    <input type="text" class="form-control font-size-14" placeholder="Saisir dans le champs ...">

                    <button type="submit" class="btn bg-gradient-primary font-size-13 btn-block mt-2">
                        Soumettre
                    </button>
                </form><hr /><br />

                <div class="text-center">
                    <b>CHANGER MON MOT DE PASSE (...)</b>
                </div><br />

                <form action="" method="post">
                    @csrf

                    <label for="ol_password">Mot de passe actuel</label>
                    <input type="text" class="form-control font-size-14" placeholder="Saisir dans le champs ...">
                    
                    <label for="ol_password" class="mt-2">Nouveau mot de passe</label>
                    <input type="text" class="form-control font-size-14" placeholder="Saisir dans le champs ...">

                    <label for="ol_password" class="mt-2">Confirmer le mot de passe</label>
                    <input type="text" class="form-control font-size-14" placeholder="Saisir dans le champs ...">

                    <button type="submit" class="btn bg-gradient-primary font-size-13 btn-block mt-2">
                        Soumettre
                    </button>
                </form><br /><br />
            </div>
        </div>
    </div>

@endsection
