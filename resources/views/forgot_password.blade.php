@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2 class="text-center">Mot de passe oublié</h2><br />
                <form action="" method="post">
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Saisir dans le champs ...">
                    
                    <button type="submit" class="btn bg-gradient-primary btn-block mt-3 mb-2">
                        Soumettre
                    </button>
                    Pas encore de compte ? <a href="{{ route('register') }}">Inscription</a>
                </form>
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('included.visitors.footer')
            </div>
        </div>
    </div>

@endsection