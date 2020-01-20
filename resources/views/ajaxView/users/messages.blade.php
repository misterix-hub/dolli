
<?php $nb_messages  = 0; ?>
@foreach (App\Contact::where('user1_id', session()->get('id'))->orWhere('user2_id', session()->get('id'))->orderByDesc('id')->get() as $contact)
    
    @foreach (Illuminate\Support\Facades\DB::select('SELECT * FROM messages
    WHERE ((user_id = ? AND dest_id = ?) OR (user_id = ? AND dest_id = ?)) AND dest_id = ? AND lu = 0 ORDER BY id DESC LIMIT 1', [
        $contact->user2_id, $contact->user1_id, $contact->user1_id, $contact->user2_id, session()->get('id')
    ]) as $message)
        @foreach (App\User::where('id', $message->user_id)->get() as $user)
            <div class="dropdown-divider"></div>
            <a href="{{ route('uMessage', $user->id) }}" class="dropdown-item pb-0 pt-0">
                <!-- Message Start -->
                <div class="media">
                    <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" alt="User Avatar" style="border: 2px solid #CCC; padding: 2px;"
                    class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                        <h3 class="dropdown-item-title font-size-13">
                            <b class="text-muted">{{ $user->name }}</b>
                        </h3>
                        <p class="text-sm text-muted mb-0">
                            @if (strlen($message->texte) > 20)
                                {{ substr($message->texte, 0, 20) }} ...
                            @else
                                {{ $message->texte }}
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
            </a>

            <?php $nb_messages += 1; ?>
        @endforeach
    @endforeach

@endforeach

<?php session()->put('nb_messages', $nb_messages) ?>