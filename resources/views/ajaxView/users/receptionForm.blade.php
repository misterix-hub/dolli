@if (count(App\User::where('cle_privee', sha1($key))->where('id', session()->get('id'))->get()) == 0)
    <br />
    <h5 class="text-danger">
        <i class="fa fa-times" aria-hidden="true"></i><br />
        Transaction non effectuée !
    </h5>
    <span class="font-weight-bold font-size-13">Clé incorrecte</span><br />
    <center>
        <div style="width: 150px;" class="border-bottom border-danger mt-2"></div>
    </center>
@else
    <br />
    @foreach (App\Transaction::where('id', $transaction)->get() as $transaction)
        @if ($transaction->confirme == 1)
            <br />
            <h5 class="text-danger">
                <i class="fa fa-times" aria-hidden="true"></i><br />
                Transaction non effectuée !
            </h5>
            <span class="font-weight-bold font-size-13">Transaction introuvable</span><br />
            <center>
                <div style="width: 150px;" class="border-bottom border-danger mt-2"></div>
            </center>
        @else

            @php
                $transaction = App\Transaction::find($transaction->id);
                $transaction->confirme = 1;
                $transaction->save();

                $user = App\User::find(session()->get('id'));
                $user->solde = $user->solde + $transaction->monant;
                $user->save();
            @endphp
            
            <h5 class="text-success">
                <i class="fa fa-check" aria-hidden="true"></i><br />
                Transaction effectuée !
            </h5>
            
            <center>
                <div style="width: 150px;" class="border-bottom border-success mt-3"></div><br />

                <a href="{{ route('uIndex') }}" class="btn btn-default pl-4 pr-4 font-size-14 pt-2 pb-2">
                    Retour à l'accueil
                </a>
            </center>
        @endif
    @endforeach
@endif