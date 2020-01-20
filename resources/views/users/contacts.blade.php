@extends('layouts.header')

@section('content')

    @include('included.users.app_bar')

    <div class="container-fluid">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-md-9 font-size-14">
                <div class="row">
                    @foreach (App\Contact::where('user1_id', session()->get('id'))->orWhere('user2_id', session()->get('id'))->get() as $contact)
                        <div class="col-md-4">
                            @if ($contact->user1_id == session()->get('id'))    
                                @foreach (App\User::where('id', $contact->user2_id)->get() as $user)
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            {{ $user->profession }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead text-truncate"><b>{{ $user->name }}</b></h2>
                                                    <p class="text-muted text-sm"><b>Bio: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-map-marker-alt text-danger"></i></span> Addresse : Lomé, TOGO</li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-envelope-open text-primary"></i></span>{{ $user->email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" style="border: 3px solid #CCC; padding: 3px;"
                                                    alt="" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="{{ route('uMessage', $user->id) }}" class="btn btn-sm bg-gradient-primary font-size-13">
                                                    <i class="fas fa-comments"></i>
                                                    Message
                                                </a>
                                                <a href="#" class="btn btn-sm btn-default font-size-13">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                    Voir le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach (App\User::where('id', $contact->user1_id)->get() as $user)
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            {{ $user->profession }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead text-truncate"><b>{{ $user->name }}</b></h2>
                                                    <p class="text-muted text-sm"><b>Bio: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-map-marker-alt text-danger"></i></span> Addresse : Lomé, TOGO</li>
                                                        <li class="small"><span class="fa-li"><i class="fas fa-envelope-open text-primary"></i></span>{{ $user->email }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" style="border: 3px solid #CCC; padding: 3px;"
                                                    alt="" class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="{{ route('uMessage', $user->id) }}" class="btn btn-sm bg-gradient-primary font-size-13">
                                                    <i class="fas fa-comments"></i>
                                                    Message
                                                </a>
                                                <a href="#" class="btn btn-sm btn-default font-size-13">
                                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                    Voir le profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
