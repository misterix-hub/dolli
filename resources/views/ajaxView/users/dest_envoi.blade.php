<?php $found = 0; ?>
@foreach (App\User::where('id', '<>', session()->get('id'))->get() as $user)
    @if (\Hash::check($key, $user->cle_publique))
        <?php
            $id_rcp = $user->id;
            $avatar_rcp = $user->avatar;
            $name_rcp = $user->name;

            $found += 1;
            break;
        ?>
    @endif
@endforeach

@if ($found == 0)
    <h5 class="text-danger">
        <i class="fa fa-times" aria-hidden="true"></i><br />
        Transaction non effectuée !
    </h5>
    <span class="font-weight-bold font-size-13">Clé incorrecte</span><br />
    <center>
        <div style="width: 150px;" class="border-bottom border-danger mt-2"></div>
    </center>
@else
    @foreach (App\User::where('id', session()->get('id'))->get() as $user_solde)
        @if ($user_solde->solde < $montant)
            <h5 class="text-danger">
                <i class="fa fa-times" aria-hidden="true"></i><br />
                Transaction non effectuée !
            </h5>
            <span class="font-weight-bold font-size-13">Solde insuffisant</span><br />
            <center>
                <div style="width: 150px;" class="border-bottom border-danger mt-2"></div>
            </center>
        @else    
            <div class="text-center" style="line-height: 10px;">
                <h5 class="text-success">
                    <i class="fa fa-check" aria-hidden="true"></i><br />
                    Transaction effectuée !
                </h5>
                <img src="{{ URL::asset('db/avatar/' . $avatar_rcp) }}" width="50" alt="" class="img-circle mb-2"><br />
                <span class="font-weight-bold font-size-13">Envoi de {{ $montant }} uryas à {{ $name_rcp }} réussi !</span>
                @php
                    /*$user_envoi = App\User::find(session()->get('id'));
                    $user_envoi->solde = $user_envoi->solde - $montant;
                    $user_envoi->save();*/

                    $transaction = new App\Transaction;
                    $transaction->id_env = session()->get('id');
                    $transaction->id_rcp = $id_rcp;
                    $transaction->monant = $montant;
                    $transaction->confirme = 0;
                    $transaction->save();
                @endphp
            </div>
        @endif
    @endforeach
@endif