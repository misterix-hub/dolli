<?php
    $transaction = count(App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 0)->get());
    $commentaire = count(App\Commentaire::where('vu', 0)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->orderByDesc('id')->get());
    $total = $transaction + $commentaire;
?>

@if ($total != 0)
    <span class="badge badge-danger pt-1 pb-1">
        {{ $total }}
    </span>
@endif