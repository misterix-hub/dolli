@extends('layouts.header')

@section('content')
    @include('included.visitors.app_bar')<br /><br /><br />

    <div class="container family-font">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <b>Il est fortement recommandé de coppier les clés ci-dessus et de les garder en lieu sûr.
                    Ce sont vos clés et elles vous seront lors de toutes vos transactions.</b>
                </div><br />

                <b>Clé privée</b>
                <h1>{{ session()->get('cle_privee') }}</h1><br />


                <b>Clé publique</b>
                <h1>{{ session()->get('cle_publique') }}</h1><br />

                <div class="text-right">
                    <a href="{{ route('uIndex') }}" class="btn float-right bg-gradient-primary pl-4 pr-4">
                        Suivant
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    <br /><br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('included.visitors.footer')
            </div>
        </div>
    </div>

@endsection