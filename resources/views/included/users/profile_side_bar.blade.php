<div class="col-12 xs-show">
    <div class="row pl-2 pr-2">         
        <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelEnvoyer">
            <i class="fas fa-sort-amount-up" style="color: orange;"></i> Envoyer
        </a>   
        <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelRecevoir">
            <i class="fas fa-lock text-danger"></i> Clés
        </a>    
        <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uContacts') }}">
            <i class="fas fa-users text-primary"></i> Contacts
        </a>
        <a href="#!" data-toggle="modal" data-target="#modelSolde" class="btn btn-default col-12 mb-2 pt-2 pb-2 btn-block font-size-13 mt-1">
            <b>Consulter mon solde</b>
        </a><br class="xs-hide" />
    </div>
</div>
<div class="col-md-3 xs-hide">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user pb-2" style="border-radius: 4px; overflow: hidden;">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header text-white"
            style="background: url('/Dolli/public/dist/img/photo1.png') center center;">
            <h3 class="widget-user-username text-right">{{ session()->get('nom_complet') }}</h3>
            <h5 class="widget-user-desc text-right">{{ session()->get('profession') }}</h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="{{ URL::asset('db/avatar/'.session()->get('avatar')) }}" alt="User Avatar">
        </div>
        <div class="card-footer" style="background-color: #FFF;">
            <div class="row pl-2 pr-2">         
                <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelEnvoyer">
                    <i class="fas fa-sort-amount-up" style="color: orange;"></i> Envoyer
                </a>   
                <a class="btn btn-app btn-block col-4 m-0" data-toggle="modal" data-target="#modelRecevoir">
                    <i class="fas fa-lock text-danger"></i> Clés
                </a>    
                <a class="btn btn-app btn-block col-4 m-0" href="{{ route('uContacts') }}">
                    <i class="fas fa-users text-primary"></i> Contacts
                </a>
            </div>
              
            <a href="#!" data-toggle="modal" data-target="#modelSolde" class="btn btn-default pt-2 pb-2 btn-block font-size-13 mt-2">
                <b>Consulter mon solde</b>
            </a><br class="xs-hide" />

            <div class="font-size-13 xs-hide">

                <strong><i class="fas fa-briefcase mr-1 text-success"></i> Formation ou emploi</strong>

                <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1 text-danger"></i> Lieu de résidence</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-phone mr-1 text-primary"></i> Coordonnées</strong>

                <p class="text-muted">
                    Email : {{ session()->get('email') }}
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Biographie</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                <hr />
                <a href="">
                    Mettre à jour mes données personnelles
                </a>
                <hr />
                <a href="">
                    Signaler un problème
                </a>
                <hr />
                <a href="{{ route('logout') }}" class="text-danger">
                    Déconnexion
                </a>
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
                <table width="100%">
                    <tr>
                        <td>
                            <label for="cle_publique">
                                <i class="fa fa-lock text-danger" aria-hidden="true"></i>
                                Clé publique
                            </label>
                            <input type="text" class="form-control font-size-13" id="cle_publique" name="cle_publique" placeholder="Saisir la clé publique ici ...">
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

                <b class="text-muted">Infos d'envoi</b>

                <div style="height: 150px; font-size: 32px;" id="envoyerContainer" class="text-center">
                    <br />
                    <span class="text-muted">En attente de clé ...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modelRecevoir" tabindex="-1" role="dialog" aria-labelledby="modelTitleRecevoir" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" style="font-weight: 100;">
                    <i class="fas fa-lock text-danger"></i>
                    Gestion de clés
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-size-14">
                <table width="100%">
                    <tr>
                        <td width="150">
                            <label for="cle_publique">
                                Ma clé publique
                            </label><br />
                            <h4 class="mt-2">{{ session()->get('cle_publique') }}</h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer text-right">
                <a href="">
                    J'ai oublié ma clé privée
                </a>
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
                <label for="cle">
                    <i class="fa fa-lock text-danger" aria-hidden="true"></i>
                    Clé privée
                </label>
                <table width="100%">
                    <tr>
                        <td>
                            <input type="text" class="form-control font-size-13" id="cle" name="cle" placeholder="Saisir la clé privée ici ...">
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

                <b class="text-muted">Solde en urya</b>

                <div style="height: 150px; line-height: 125px; font-size: 32px;" id="soldeContainer" class="text-center">
                    <span class="text-muted">En attente de clé ...</span>
                </div>
            </div>
        </div>
    </div>
</div>