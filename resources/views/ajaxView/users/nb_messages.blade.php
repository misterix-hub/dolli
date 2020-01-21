@if (count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) != 0)
    <span class="badge badge-danger pt-1 pb-1" style="margin-left: -4px;">
        {{ count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) }}
    </span>
@endif