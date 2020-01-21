@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2>Connexion à un compte</h2><br />
                @if ($message = Session::get('error'))    
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif
                <form action="{{ route('loginForm') }}" method="post">
                    @csrf
                    <label for="email">Email</label>
                    <input type="email" required id="email" name="email" class="form-control" placeholder="Saisir dans le champs ...">
                    <label for="password" class="mt-3">Mot de passe</label>
                    <input type="password" required id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">

                    <button type="submit" class="btn bg-gradient-primary btn-block mt-4">
                        Se connecter
                    </button><br />
                    <a href="{{ route('forgot_password') }}">Mot de passe oublié ?</a>
                </form>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <h1 class="mb-0">
                    Dolli    
                </h1>
                <span style="color: orangered;">La plate-forme des uryas</span><br /><br />

                <h5 style="line-height: 30px; text-align: justify;">
                    Si vous n'avez pas encore de compte, veuillez le créer dès
                    maintenant pour bénéficier gratuitement de 3000 uryas pour commencer.
                    L'inscription se fait gratuitement et vous prendra tout au plus 2 minutes
                    pour terminer.
                </h5><br />

                <div class="text-right">
                    <a href="{{ route('register') }}" style="background-color: #e66937;"
                    class="btn btn-lg pl-5 pr-5 text-light">
                        Créer un compte
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('included.visitors.footer')
            </div>
        </div>
    </div>

@endsection