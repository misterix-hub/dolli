@extends('layouts.header')

@section('content')

    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-md-9 font-size-14">
                <div class="row">
                    <div class="col-12">
                        <small><b>CONTACTS</b></small>
                    </div>
                    @forelse (App\Contact::where('user1_id', session()->get('id'))->orWhere('user2_id', session()->get('id'))->get() as $contact)
                        @if ($contact->user1_id == session()->get('id'))    
                            @foreach (App\User::where('id', $contact->user2_id)->get() as $user)
                                <div class="col-md-4">
                                    <div class="card bg-light pt-2">
                                        <div class="card-body pt-0 pl-2 pr-2 pb-0">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="lead text-truncate"><b>{{ $user->name }}</b></h2>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted font-size-13">
                                                        <li><span class="fa-li"><i class="fas fa-envelope-open text-primary"></i></span>{{ $user->email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" style="border: 3px solid #CCC; padding: 3px;"
                                                    alt="" class="img-circle img-fluid" width="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer pr-2 pl-2 pt-2 pb-2">
                                            <div class="text-right">
                                                <a href="{{ route('uMessage', $user->id) }}" class="btn text-light btn-sm font-size-13 pl-3 pr-3" style="background-color: #e66937;">
                                                    <i class="fas fa-comments"></i>
                                                    Message
                                                </a>
                                                <a href="{{ route('uProfil', $user->id) }}" class="btn bg-gradient-secondary btn-sm font-size-13 pl-3 pr-3">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                    Voir le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach (App\User::where('id', $contact->user1_id)->get() as $user)   
                                <div class="col-md-4">
                                    <div class="card bg-light pt-2">
                                        <div class="card-body pt-0 pl-2 pr-2 pb-0">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="lead text-truncate"><b>{{ $user->name }}</b></h2>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted font-size-13">
                                                        <li><span class="fa-li"><i class="fas fa-envelope-open text-primary"></i></span>{{ $user->email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" style="border: 3px solid #CCC; padding: 3px;"
                                                    alt="" class="img-circle img-fluid" width="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer pr-2 pl-2 pt-2 pb-2">
                                            <div class="text-right">
                                                <a href="{{ route('uMessage', $user->id) }}" class="btn text-light btn-sm font-size-13 pl-3 pr-3" style="background-color: #e66937;">
                                                    <i class="fas fa-comments"></i>
                                                    Message
                                                </a>
                                                <a href="{{ route('uProfil', $user->id) }}" class="btn bg-gradient-secondary btn-sm font-size-13 pl-3 pr-3">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                    Voir le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                        @endif
                    @empty
                        <div class="col-12 text-center"><br />
                            <i class="fa fa-user-times fa-2x text-muted" aria-hidden="true"></i><br />
                            Pas de contact enregistré !
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
