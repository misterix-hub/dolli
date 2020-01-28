
<?php $nb_messages  = 0; ?>
@foreach (App\Contact::where('user1_id', session()->get('id'))->orWhere('user2_id', session()->get('id'))->orderByDesc('id')->get() as $contact)
    
    @foreach (Illuminate\Support\Facades\DB::select('SELECT * FROM messages
    WHERE ((user_id = ? AND dest_id = ?) OR (user_id = ? AND dest_id = ?)) AND dest_id = ? AND lu = 0 ORDER BY id DESC LIMIT 1', [
        $contact->user2_id, $contact->user1_id, $contact->user1_id, $contact->user2_id, session()->get('id')
    ]) as $message)
        @foreach (App\User::where('id', $message->user_id)->get() as $user)
            <a href="{{ route('uMessage', $user->id) }}" class="dropdown-item pl-2 pr-2 pt-0 pb-0">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" alt="User Avatar" style="border: 2px solid #CCC; padding: 2px;"
                    class="mr-2 img-circle" width="45">
                    <div class="media-body">
                        <h3 class="dropdown-item-title font-size-13">
                            <b class="text-primary">{{ $user->name }}</b>
                        </h3>
                        <p class="text-sm mt-0" style="color: #000; margin-bottom: -5px;">
                            @if (strlen($message->texte) > 25)
                                <b>{{ substr($message->texte, 0, 25) }} ...</b>
                            @else
                                <b>{{ $message->texte }}</b>
                            @endif
                        </p>
                        <small class="text-muted">
                            Envoyé le 
                            {{ substr($message->created_at, 8, 2) }} /
                            {{ substr($message->created_at, 5, 2) }} à
                            {{ substr($message->created_at, 11, 2) }} h
                            {{ substr($message->created_at, 14, 2) }} min.
                        </small>
                    </div>
                </div>
                <!-- Message End -->
            </a><div class="dropdown-divider"></div>

            <?php $nb_messages += 1; ?>
        @endforeach
    @endforeach

@endforeach

@if ($nb_messages == 0)
    <div class="text-center text-muted"><br /><br />
        <i class="fa fa-trash text-muted fa-3x" aria-hidden="true"></i><br />
        Pas de message non lu !
    </div>
@endif