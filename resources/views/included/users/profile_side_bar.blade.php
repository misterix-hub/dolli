<div class="col-12 xs-show">
    <div class="row pl-2 pr-2">           
        <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uCompte') }}">
            <i class="fas fa-user-circle text-success"></i> Profil
        </a>    
        <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uContacts') }}">
            <i class="fas fa-users text-primary"></i> Contacts
        </a>
        <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelEnvoyer">
            <i class="fas fa-sort-amount-up" style="color: orange;"></i> Envoyer
        </a> 
        <a href="#!" data-toggle="modal" data-target="#modelSolde" class="btn btn-default col-12 mb-2 pt-2 pb-2 btn-block font-size-13 mt-1">
            <b>Consulter mon solde</b>
        </a><br class="xs-hide" />
    </div>
</div>
<div class="col-md-3 col-sm-12 xs-hide">
    <!-- Widget: user widget style 1 -->
    <div class="widget-user pb-2 pr-3 pl-1 pt-2"
    style="overflow: hidden; position: fixed; width: 23.5%; bottom: 0; border-right: 1px solid #CCC; top: 60px;">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white"
            style="background: url('/Dolli/public/db/covers/{{ session()->get('couverture') }}') center center; height: 110px;">
            <h3 class="widget-user-username text-right" style="font-family: jura;">{{ session()->get('nom_complet') }}</h3>
        </div>
        <div class="widget-user-image" style="margin-top: -10px;">
            <a href="{{ route('photoProfil') }}">
                <img class="img-circle" width="80" src="{{ URL::asset('db/avatar/'.session()->get('avatar')) }}" 
                style="border: 2px solid #FFF;x" alt="User Avatar">
            </a>
        </div><br /><br />
        <div class="">
            <div class="row pl-2 pr-2">            
                <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uCompte') }}">
                    <i class="fas fa-user-circle text-success"></i> Profil
                </a>    
                <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uContacts') }}">
                    <i class="fas fa-users text-primary"></i> Contacts
                </a>
                <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelEnvoyer">
                    <i class="fas fa-sort-amount-up" style="color: orange;"></i> Envoyer
                </a>
            </div>
              
            <a href="#!" data-toggle="modal" data-target="#modelSolde" class="btn btn-default pt-2 pb-2 btn-block font-size-13 mt-2">
                <b>Consulter mon solde</b>
            </a><br class="xs-hide" />

            <div class="font-size-13 xs-hide">

                <strong><i class="fas fa-phone mr-1 text-primary"></i> Coordonnées</strong>

                <p class="text-muted">
                    Email : {{ session()->get('email') }}
                </p>

                <strong>
                    <i class="fa fa-info-circle mr-1"></i> 
                    A propos de moi
                </strong>

                <p class="text-muted">{{ session()->get('profession') }}</p>
                <br />
                <div style="line-height: 25px;">
                    <a href="{{ route('uCompte') }}">
                        Mettre à jour mon profil
                    </a>
                    <br />
                    <a href="#!">
                        Signaler un problème (...)
                    </a>
                    <br />
                    <a href="{{ route('logout') }}" class="text-danger">
                        Déconnexion
                    </a><hr class="mb-0" />

                    Dolli &copy; 2020 | By <a href="mailto:ngabalazare3@gmail.com">ngabalazare3@gmail.com</a>
                </div>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>        
</div>

<div class="modal fade" id="modelEnvoyer" tabindex="-1" role="dialog" aria-labelledby="modelTitleEnvoyer" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="font-weight: 100;">
                    <i class="fas fa-sort-amount-up" style="color: orange;"></i>
                    Envoyer les uryas
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-size-14">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    Notez qu'apès soumission de la clé, aucune réclamation,
                    revendication , ni annulation, ni correction n'est possible.
                </div>
                <form action="#!" id="sendForm">
                    <table width="100%">
                        <tr>
                            <td>
                                <label for="cle_publique">
                                    <i class="fa fa-lock text-danger" aria-hidden="true"></i>
                                    Clé publique
                                </label>
                                <input type="text" required class="form-control font-size-13" id="cle_publique" name="cle_publique" autocomplete="off" placeholder="Saisir la clé publique ici ...">
                            </td>
                            <td width="100">
                                <label for="montant">
                                    Montant
                                </label>
                                <input type="number" min="1" max="10000" class="form-control font-size-13" id="montant" name="montant" placeholder="Saisir l montant ici ...">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="pt-1">
                                <button id="envoyerBtn" class="btn bg-gradient-primary font-size-13 pt-2 pb-2 btn-block">
                                    Envoyer
                                </button>
                            </td>
                        </tr>
                    </table><br />
                </form>

                <b class="text-muted">Infos d'envoi</b>

                <div style="height: 150px; font-size: 32px;" id="envoyerContainer" class="text-center">
                    <br />
                    <span class="text-muted">En attente de clé ...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelSolde" tabindex="-1" role="dialog" aria-labelledby="modelTitleSolde" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="font-weight: 100;">
                    <i class="fas fa-coins"></i>
                    Consulter mon solde
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-size-14">
                <label for="cle_prv">
                    <i class="fa fa-lock text-danger" aria-hidden="true"></i>
                    Clé privée
                </label>
                <form action="#!" id="soldeForm">
                    <table width="100%">
                        <tr>
                            <td>
                                <input type="text" autocomplete="off" required class="form-control font-size-13" id="cle_prv" name="cle_prv" placeholder="Saisir la clé privée ici ...">
                            </td>
                        </tr>
                        <tr>
                            <td class="pt-2">
                                <button type="submit" id="getSoldeBtn" class="btn bg-gradient-primary font-size-13 pt-2 pb-2 btn-block">
                                    Soumettre
                                </button>
                            </td>
                        </tr>
                    </table><br />
                </form>

                <b class="text-muted">Solde en urya</b>

                <div style="height: 150px; line-height: 125px; font-size: 32px;" id="soldeContainer" class="text-center">
                    <span class="text-muted">En attente de clé ...</span>
                </div>
            </div>
        </div>
    </div>
</div>