<nav class="navbar navbar-expand-sm navbar-light bg-light family-font">
    <a class="navbar-brand mr-4" href="#">
        Dolli
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    En savoir plus
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    Contacts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i>
                    Connexion
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a name="" id="" class="btn bg-gradient-primary pl-4 pr-4" href="{{ route('register') }}" role="button">
                Créer un compte
            </a>
        </form>
    </div>
</nav>