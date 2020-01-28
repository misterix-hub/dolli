@extends('layouts.header')

@section('content')

    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-md-2 col-sm-12">
            </div>
            <div class="col-md-4 col-sm-12 font-size-13">

                @foreach (App\User::where('id', $id)->get() as $user)
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

                            <a href="{{ route('uMessage', $user->id) }}" style="background-color: #e66937;"
                            class="float-right btn text-light font-size-13 pl-4 pr-4">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                Message
                            </a><br /><br />

                            <b>Email</b> : {{ $user->email }}<hr />

                            <b>Plus sur {{ substr($user->name, 0, strpos($user->name, " ")) }}</b> : <br />
                            {{ $user->profession }}<br /><br />

                            <ul>
                                <li>
                                    <a href="">
                                        Signaler cette personne (...)
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:{{ $user->email }}">
                                        Envoyer un mail
                                    </a>
                                </li>
                            </ul>

                            
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
