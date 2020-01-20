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
                    <label for="nom_complet">Nom complet</label>
                    <input type="text" required id="nom_complet" name="nom_complet" class="form-control" placeholder="Saisir dans le champs ...">

                    <label for="profession" class="mt-2">Profession</label>
                    <input type="text" required id="profession" name="profession" class="form-control" placeholder="Saisir dans le champs ...">
                    
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