@if (count(App\User::where('id', session()->get('id'))->where('cle_privee', sha1($key))->get()) == 0)
    <span class="text-danger">Clé incorrecte !</span>
@else
    @foreach (App\User::where('cle_privee', sha1($key))->get() as $user)
        {{ $user->solde }}
        <small class="font-size-14"><b>urys</b></small>
    @endforeach
@endif