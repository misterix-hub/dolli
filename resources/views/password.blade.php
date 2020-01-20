@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2 class="text-center">Choisissez un mot de passe</h2><br />

                @if ($message = Session::get('error'))
                    
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif


                <form action="{{ route('passwordForm') }}" method="post">
                    @csrf
                    <label for="password">Mot de passe</label>
                    <input type="password" minlength="6" id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">

                    <label for="password_confirm" class="mt-2">Confirmer le mot de passe</label>
                    <input type="password" minlength="6" id="password_confirm" name="password_confirm" class="form-control" placeholder="Saisir dans le champs ...">
                    
                    <button type="submit" class="btn bg-gradient-primary btn-block mt-3 mb-2">
                        Suivant
                    </button>
                </form>
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('included.visitors.footer')
            </div>
        </div>
    </div>

@endsection