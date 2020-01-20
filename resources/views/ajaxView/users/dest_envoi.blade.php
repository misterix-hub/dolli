@if (count(App\User::where('cle_publique', $key)->where('id', '<>', session()->get('id'))->get()) == 0)
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
            @foreach (App\User::where('cle_publique', $key)->get() as $user)
            <div class="text-center" style="line-height: 10px;">
                <h5 class="text-success">
                    <i class="fa fa-check" aria-hidden="true"></i><br />
                    Transaction effectuée !
                </h5>
                <img src="{{ URL::asset('db/avatar/' . $user->avatar) }}" width="50" alt="" class="img-circle mb-2"><br />
                <span class="font-weight-bold font-size-13">Envoi de {{ $montant }} uryas à {{ $user->name }} réussi !</span>
                @php
                    $user_envoi = App\User::find(session()->get('id'));
                    $user_envoi->solde = $user_envoi->solde - $montant;
                    $user_envoi->save();

                    $transaction = new App\Transaction;
                    $transaction->id_env = session()->get('id');
                    $transaction->id_rcp = $user->id;
                    $transaction->monant = $montant;
                    $transaction->confirme = 0;
                    $transaction->save();
                @endphp
            </div>
            @endforeach
        @endif
    @endforeach
@endif