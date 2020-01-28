@foreach (App\User::where('id', session()->get('id'))->get() as $user)
    @if (\Hash::check($key, $user->cle_privee))
        {{ $user->solde }}
        <small class="font-size-14"><b>uryas</b></small>
    @else
        <span class="text-danger">Clé incorrecte !</span>
    @endif
@endforeach