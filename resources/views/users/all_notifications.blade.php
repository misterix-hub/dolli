@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 68px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-lg-6 col-md-12 col-sm-12 font-size-13">   
                <i class="fa fa-bell" aria-hidden="true"></i>
                <b>Toutes les notifications</b><br />

                @forelse (App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 0)->orderByDesc('id')->get() as $transaction)
                    @foreach (App\User::where('id', $transaction->id_env)->get() as $user)
                        @if ($transaction->confirme == 0)
                            <b>
                                <a href="{{ route('receptions', $transaction->id) }}">
                                    <div style="color: #000; background-color: #EEE;" class="p-1 mb-1">
                                        <span class="text-success">
                                            <i class="fas fa-sort-amount-down"></i>
                                            <b>{{ $user->name }}</b>
                                        </span>
                                        vous a envoyé <b>{{ $transaction->monant }} uryas</b>. Cliquez pour ici confirmer ...<br />
                                        <small>Transaction : {{ $transaction->created_at }}</small>
                                    </div>
                                </a>
                            </b>
                        @else
                            <a href="#!">
                                <div class="text-muted">
                                    <span class="text-success">
                                        <i class="fas fa-sort-amount-down"></i>
                                        <b>{{ $user->name }}</b>
                                    </span>
                                    vous a envoyé <b>{{ $transaction->monant }} uryas</b>. Vous avez déjà confirmé cette transaction.<br />
                                    <small>Transaction : {{ $transaction->created_at }}</small>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @empty

                @endforelse

                @forelse (App\Commentaire::where('vu', 0)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->orderByDesc('id')->get() as $commentaire)
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('publication', $commentaire->publication_id) }}">
                        <div style="color: #000; background-color: #EEE;" class="p-1">
                            <span>
                                <i class="fas fa-comments"></i>
                                
                                @foreach (App\User::where('id', $commentaire->user_id)->get() as $user_comment)    
                                    <b class="text-primary">{{ $user_comment->name }}</b>
                                    a fait un commentaire suite à votre publication ...
                                    <small>{{ $commentaire->created_at }}</small><br />
                                    <span style="color: #000">
                                        @if (strlen($commentaire->texte) > 60)
                                            <b>{{ substr($commentaire->texte, 0, 60) }} ...</b>
                                        @else
                                            <b>{{ $commentaire->texte }}</b>
                                        @endif
                                    </span>
                                @endforeach

                            </span>
                        </div>
                    </a>
                @empty

                @endforelse


                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- -->
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- -->
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- -->


                

                @forelse (App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 1)->orderByDesc('id')->get() as $transaction)
                    @foreach (App\User::where('id', $transaction->id_env)->get() as $user)
                        <a href="#!">
                            <div class="text-muted border-bottom mb-1 pb-1">
                                <span class="text-success">
                                    <i class="fas fa-sort-amount-down"></i>
                                    <b>{{ $user->name }}</b>
                                </span>
                                vous a envoyé <b>{{ $transaction->monant }} uryas</b>. Vous avez déjà confirmé cette transaction.<br />
                                <small>Transaction : {{ $transaction->created_at }}</small>
                            </div>
                        </a>
                    @endforeach
                @empty

                @endforelse

                @forelse (App\Commentaire::where('vu', 1)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->orderByDesc('id')->get() as $commentaire)
                    <a href="{{ route('publication', $commentaire->publication_id) }}">
                        <div class="text-muted border-bottom mb-1 pb-1">
                            <span>
                                <i class="fas fa-comments"></i>
                                
                                @foreach (App\User::where('id', $commentaire->user_id)->get() as $user_comment)    
                                    <b class="text-primary">{{ $user_comment->name }}</b>
                                    a fait un commentaire suite à votre publication ...
                                    <small>{{ $commentaire->created_at }}</small><br />
                                    <span style="color: #000">
                                        @if (strlen($commentaire->texte) > 60)
                                            <b>{{ substr($commentaire->texte, 0, 60) }} ...</b>
                                        @else
                                            {{ $commentaire->texte }}
                                        @endif
                                    </span>
                                @endforeach

                            </span>
                        </div>
                    </a>
                @empty

                @endforelse

            </div>
        </div>
    </div><br />

@endsection