@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2 class="text-center">Création de compte</h2><br />
                <form action="{{ route('registerForm') }}" method="post">
                    @csrf
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            {{ $message }}
                        </div>
                    @endif
                    <label for="email">Email</label>
                    <input type="email" required id="email" maxlength="50" minlength="10" name="email" class="form-control" placeholder="Saisir dans le champs ...">
                    
                    <button type="submit" class="btn bg-gradient-primary btn-block mt-3 mb-2">
                        Soumettre
                    </button>
                    Déjà membre ? <a href="{{ route('login') }}">Se connecter</a>
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