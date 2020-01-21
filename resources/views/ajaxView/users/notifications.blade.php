<?php $not1 = 0; $not2 = 0; ?>
@forelse (App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 0)->orderByDesc('id')->get() as $transaction)
    @foreach (App\User::where('id', $transaction->id_env)->get() as $user)
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('receptions', $transaction->id) }}">
            <div class="text-muted">
                <span class="text-success">
                    <i class="fas fa-sort-amount-down"></i>
                    <b>{{ $user->name }}</b>
                </span>
                vous a envoyé <b>{{ $transaction->monant }} urys</b>.<br />Cliquez pour confirmer ...
                <small>{{ $transaction->created_at }}</small>
            </div>
        </a>
        <?php $not1 += 1; ?>
    @endforeach
@empty

        <div class="dropdown-divider"></div>
        <a class="dropdown-item">
            <div class="text-center">
                Pas de transaction en cours
            </div>
        </a>

@endforelse

@forelse (App\Commentaire::where('vu', 0)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->orderByDesc('id')->get() as $commentaire)
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('publication', $commentaire->publication_id) }}">
        <div class="text-muted">
            <span>
                <i class="fas fa-comments"></i>
                
                @foreach (App\User::where('id', $commentaire->user_id)->get() as $user_comment)    
                    <b class="text-primary">{{ $user_comment->name }}</b>
                    a fait un commentaire<br />suite à votre publication ...
                    <small>{{ $commentaire->created_at }}</small><br />
                    <span style="color: #000">
                        @if (strlen($commentaire->texte) > 35)
                            {{ substr($commentaire->texte, 0, 35) }} ...
                        @else
                            {{ $commentaire->texte }}
                        @endif
                    </span>
                @endforeach

            </span>
        </div>
    </a>
    <?php $not2 += 1; ?>
@empty

    <div class="dropdown-divider"></div>
    <a class="dropdown-item">
        <div class="text-center">
            Pas de commentaires en vue
        </div>
    </a>
    <div class="dropdown-divider"></div>

@endforelse

<?php session()->put('nb_notifications', $not1 + $not2) ?>