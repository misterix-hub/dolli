@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h2 class="text-center" style="line-height: 50px;">
                    <i class="fas fa-envelope-open-text fa-2x" style="color: green;"></i><br />
                    Mail envoyé
                </h2><br />

                <div class="text-center">
                    Un mail vient d'être envoyé à l'adresse que vous avez saisi.
                    Vérifiez votre boite mail puis utilisez le lien pour
                    la suite de la procédure.
                </div>
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