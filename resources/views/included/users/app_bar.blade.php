<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: fixed; top: 0; left: 0; right: 0;">
    <!-- Left navbar links -->
    <ul class="navbar-nav font-size-14">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('uIndex') }}">
                <span style="font-size: 16px; font-family: Marmelad;"><b>Dolli</b></span>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block mt-1">
            <a href="{{ route('uIndex') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block mt-1">
            <a href="{{ route('uContacts') }}" class="nav-link">Contacts</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3 xs-hide" action="{{ route('result_search') }}" method="GET">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" style="padding-top: 18px; padding-bottom: 18px; width: 400px;"
            type="search" placeholder="Rechercher une personne ..." required aria-label="Search" name="search_q">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item mr-3 xs-show"  style="padding-top: 9px;">
            <a href="{{ route('allMessages') }}">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <small id="nbMessageContainer">
                    @if (count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) != 0)
                        <span class="badge badge-danger pt-1 pb-1" style="margin-left: -4px;">
                            {{ count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) }}
                        </span>
                    @endif
                </small>
            </a>
        </li>
        <li class="nav-item mr-3 xs-show"  style="padding-top: 9px;">
            <a href="{{ route('allNotifications') }}">
                <i class="fa fa-bell" aria-hidden="true"></i><small id="nbNotification">
                <?php
                    $transaction = count(App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 0)->get());
                    $commentaire = count(App\Commentaire::where('vu', 0)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->get());
                    $total = $transaction + $commentaire;
                ?>

                @if ($total != 0)
                    <span class="badge badge-danger pt-1 pb-1" style="margin-left: -4px;">
                        {{ $total }}
                    </span>
                @endif
                </small>
            </a>
        </li>
        <li class="nav-item mr-3 xs-hide" style="padding-top: 9px;">

            <div class="dropdown open">
                <a href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <small id="nbMessageContainer">
                        @if (count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) != 0)
                            <span class="badge badge-danger pt-1 pb-1" style="margin-left: -4px;">
                                {{ count(App\Message::where('dest_id', session()->get('id'))->where('lu', 0)->get()) }}
                            </span>
                        @endif
                    </small>
                </a>
                <div class="dropdown-menu dropdown-menu-right font-size-13" aria-labelledby="triggerId">
                    <div class="text-center"><small>MESSAGES</small></div>
                    <div class="dropdown-divider"></div>
                    <div class="text-center">
                        <a class="dropdown-item text-primary" href="{{ route('allMessages') }}">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <b>Tous les anciens messages</b>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class='font-size-13' style='height: 300px !important; overflow: auto; width: 300px;' aria-labelledby='triggerId;'>
                        <div id='messagesNotificationContainer' class='mb-2'>
                            <div class='text-center'>
                                <img src='{{ URL::asset("assets/images/30.gif") }}' width='100'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item mr-3 xs-hide" style="padding-top: 9px;">

            <div class="dropdown open">
                <a href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="fa fa-bell" aria-hidden="true"></i><small id="nbNotification">
                    <?php
                        $transaction = count(App\Transaction::where('id_rcp', session()->get('id'))->where('confirme', 0)->get());
                        $commentaire = count(App\Commentaire::where('vu', 0)->where('post_id', session()->get('id'))->where('user_id', '<>', session()->get('id'))->get());
                        $total = $transaction + $commentaire;
                    ?>
    
                    @if ($total != 0)
                        <span class="badge badge-danger pt-1 pb-1" style="margin-left: -4px;">
                            {{ $total }}
                        </span>
                    @endif
                    </small>
                </a>
                <div class="dropdown-menu dropdown-menu-right font-size-13" aria-labelledby="triggerId">
                    <div class="text-center"><small>NOTIFICATIONS</small></div>
                    <div class="dropdown-divider"></div>
                    <div class="text-center">
                        <a class="dropdown-item text-primary" href="{{ route('allNotifications') }}">
                            <i class="fa fa-archive" aria-hidden="true"></i>
                            <b>Toutes les anciennes notifications</b>
                        </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class='font-size-13' style='height: 350px !important; overflow: auto; width: 310px;' aria-labelledby='triggerId;'>
                        <div id='notificationContainer' class='mb-2'>
                            <div class='text-center'>
                                <img src='{{ URL::asset("assets/images/30.gif") }}' width='100'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </li>
        <li class="nav-item mr-3" style="padding-top: 10px;">
            <div class="dropdown">
                <a href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right font-size-13" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('uCompte') }}">
                        Mon profil
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        Se déconnecter
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item mt-1">
            <a href="{{ route('photoProfil') }}" class="nav-link pt-0 pb-0 pl-0">
                <small><b>{{ substr(session()->get('nom_complet'), 0, strpos(session()->get('nom_complet'), " ")) }}</b></small>
                <img width="35" class="img-circle" style="border: 2px solid #CCC; padding: 2px;"
                src="{{ URL::asset('db/avatar/'.session()->get('avatar')) }}" alt="avatar-img" width="100%">
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->