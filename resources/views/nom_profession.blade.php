@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2 class="text-center">Nom complet et profession</h2><br />
                <form action="{{ route('datasForm') }}" method="post">
                    @csrf
                    <label for="nom_complet">Nom compet *</label>
                    <input type="text" required id="nom_complet" minlength="3" name="nom_complet" class="form-control" placeholder="Saisir dans le champs ...">
                    <br />

                    <label for="profession">
                        Dites en quelques lignes votre domaine de compétence
                        ou ce que vous prévoyez échanger contre les uryas sur la plate-forme. *
                    </label>
                    <textarea minlength="5" type="text" required id="profession" name="profession" class="form-control"
                    placeholder="Par exemple : Je vends des chassures pour hommes et femmes ou je suis administrateur réseaux."></textarea>
                    
                    <button type="submit" class="btn bg-gradient-primary btn-block mt-3 mb-2">
                        Suivant
                    </button>
                </form>
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('included.visitors.footer')
            </div>
        </div>
    </div>

@endsection