@foreach (Illuminate\Support\Facades\DB::select('SELECT * FROM messages WHERE (user_id = ? AND dest_id = ?)
OR (user_id = ? AND dest_id = ?)', [session()->get('id'), $dest_id, $dest_id, session()->get('id')]) as $message)
    @if ($message->dest_id == session()->get('id'))
        <tr>
            <td class="pr-5">
                <div>
                    <div style="background-color: #EEE; border-radius: 25px; line-height: 15px;"
                    class="font-size-13 pt-2 pb-2 pl-3 pr-3 float-left mb-1">
                        {{ $message->texte }}
                    </div>
                </div>
            </td>
            <td width="20"></td>
        </tr>
    @else
        <tr>
            <td class="pl-4">
                <div>
                    <div style="border-radius: 25px; line-height: 15px;"
                    class="font-size-13 pt-2 pb-2 pl-3 pr-3 float-right mb-1 bg-primary">
                        {{ $message->texte }}
                    </div>
                </div>
            </td>
            <td class="font-size-13 text-right" width="20">
                <small>
                    @if ($message->lu == 0)
                       <span style="color: #AAA;"><i class="fa fa-check" aria-hidden="true"></i><i style="margin-left: -5px;" class="fa fa-check" aria-hidden="true"></i></span> 
                    @else
                        <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i><i style="margin-left: -5px;" class="fa fa-check" aria-hidden="true"></i></span>
                    @endif
                </small>
            </td>
        </tr>
    @endif
@endforeach