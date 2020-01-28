@foreach (Illuminate\Support\Facades\DB::select('SELECT * FROM messages WHERE (user_id = ? AND dest_id = ?)
OR (user_id = ? AND dest_id = ?)', [session()->get('id'), $dest_id, $dest_id, session()->get('id')]) as $message)
 
    @if ($message->dest_id == session()->get('id'))
        @if ($message->rendu_dest == 0)    
            <tr>
                <td class="pr-5">
                    <div>
                        <div style="background-color: #DDD; border-radius: 25px; line-height: 15px;"
                        class="font-size-13 pt-2 pb-2 pl-3 pr-3 float-left mb-1">
                            {{ $message->texte }}
                        </div>
                    </div>
                </td>
            </tr>
            @php
                $message_rendu = App\Message::find($message->id);
                $message_rendu->rendu_dest = 1;
                $message_rendu->save();
            @endphp
        @endif
    @else
        @if ($message->rendu_send == 0)    
            <tr>
                <td class="pl-4">
                    <div>
                        <div style="border-radius: 25px; line-height: 15px; background-color: #e66937;"
                        class="font-size-13 pt-2 pb-2 pl-3 pr-3 float-right mb-1 text-light">
                            {{ $message->texte }}
                        </div>
                    </div>
                </td>
            </tr>
            @php
                $message_rendu = App\Message::find($message->id);
                $message_rendu->rendu_send = 1;
                $message_rendu->save();
            @endphp
        @endif
    @endif

@endforeach