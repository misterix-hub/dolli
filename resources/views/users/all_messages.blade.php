@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 68px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-lg-6 col-md-12 col-sm-12 font-size-14">  
                <i class="fa fa-envelope" aria-hidden="true"></i> 
                <b>Tous les messages</b><br />


                @foreach (App\Contact::where('user1_id', session()->get('id'))->orWhere('user2_id', session()->get('id'))->orderByDesc('id')->get() as $contact)
                    @foreach (Illuminate\Support\Facades\DB::select('SELECT * FROM messages
                    WHERE (user_id = ? AND dest_id = ?) or (user_id = ? AND dest_id = ?) ORDER BY id DESC LIMIT 1', [
                        $contact->user2_id, $contact->user1_id, $contact->user1_id, $contact->user2_id
                    ]) as $message)
                        @if ($message->user_id == session()->get('id'))
                            @foreach (App\User::where('id', $message->dest_id)->get() as $user1)    
                                <a href="{{ route('uMessage', $message->dest_id) }}" class="">
                                    <table width="100%" class="border-bottom">
                                        <tr>
                                            <td width="60" class="pl-3">
                                                <img class="img-circle mb-2" style="border: 2px solid #CCC; padding: 2px;"
                                            src="{{ URL::asset('db/avatar/' . $user1->avatar) }}" alt="User Image" width="100%">
                                            </td>
                                            <td class="font-size-13 pl-2 pt-2 pb-2">
                                                <div class="text-truncate">
                                                    <span><b>{{ $user1->name }}</b></span><br />
                                                    <span class="text-secondary">
                                                        <span>
                                                            <small>Moi :</small>
                                                        </span>
                                                        @if (strlen($message->texte) > 60)
                                                            {{ substr($message->texte, 0, 60) }} ...
                                                        @else
                                                            {{ $message->texte }}
                                                        @endif
                                                    </span><br />
                                                    <small class="text-muted">
                                                        Envoyé le 
                                                        {{ substr($message->created_at, 8, 2) }} /
                                                        {{ substr($message->created_at, 5, 2) }} à
                                                        {{ substr($message->created_at, 11, 2) }} h
                                                        {{ substr($message->created_at, 14, 2) }} min.
                                                    </small>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </a>
                            @endforeach
                        @else
                            @foreach (App\User::where('id', $message->user_id)->get() as $user2)
                                @if ($message->lu == 0)
                                    <a href="{{ route('uMessage', $message->user_id) }}" class="">
                                        <table width="100%" class="border-bottom" style="background-color: #EEE;">
                                            <tr>
                                                <td width="60" class="pl-3">
                                                    <img class="img-circle mb-2" style="border: 2px solid #CCC; padding: 2px;"
                                                src="{{ URL::asset('db/avatar/' . $user2->avatar) }}" alt="User Image" width="100%">
                                                </td>
                                                <td class="font-size-13 pl-2 pt-2 pb-2">
                                                    <div class="text-truncate">
                                                        <span><b>{{ $user2->name }}</b></span><br />
                                                        <span style="color: #000;">
                                                            @if (strlen($message->texte) > 30)
                                                                <b>{{ substr($message->texte, 0, 30) }} ...</b>
                                                            @else
                                                                <b>{{ $message->texte }}</b>
                                                            @endif
                                                        </span><br />
                                                        <small class="text-muted">
                                                            Envoyé le 
                                                            {{ substr($message->created_at, 8, 2) }} /
                                                            {{ substr($message->created_at, 5, 2) }} à
                                                            {{ substr($message->created_at, 11, 2) }} h
                                                            {{ substr($message->created_at, 14, 2) }} min.
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-right font-size-13 pr-2">
                                                    <small>
                                                        <i class="fa fa-circle text-primary" aria-hidden="true"></i>
                                                    </small>
                                                </td>
                                            </tr>
                                        </table>
                                    </a>
                                @else
                                    <a href="{{ route('uMessage', $message->user_id) }}" class="">
                                        <table width="100%" class="border-bottom">
                                            <tr>
                                                <td width="60" class="pl-3">
                                                    <img class="img-circle mb-2" style="border: 2px solid #CCC; padding: 2px;"
                                                src="{{ URL::asset('db/avatar/' . $user2->avatar) }}" alt="User Image" width="100%">
                                                </td>
                                                <td class="font-size-13 pl-2 pt-2 pb-2">
                                                    <div class="text-truncate">
                                                        <span><b>{{ $user2->name }}</b></span><br />
                                                        <span class="text-secondary">
                                                            @if (strlen($message->texte) > 30)
                                                                {{ substr($message->texte, 0, 30) }} ...
                                                            @else
                                                                {{ $message->texte }}
                                                            @endif
                                                        </span><br />
                                                        <small class="text-muted">
                                                            Envoyé le 
                                                            {{ substr($message->created_at, 8, 2) }} /
                                                            {{ substr($message->created_at, 5, 2) }} à
                                                            {{ substr($message->created_at, 11, 2) }} h
                                                            {{ substr($message->created_at, 14, 2) }} min.
                                                        </small>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endforeach

            </div>
        </div>
    </div><br />

@endsection