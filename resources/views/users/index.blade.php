@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 68px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-md-6 col-sm-12">

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        {{ $message }}
                    </div>
                @endif

                <div class="font-size-14">
                    <small><b>FAIRE UNE PUBLICATION</b></small>
                </div>


                <form action="{{ route('publicationStore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <textarea name="texte" minlength="2" maxlength="300" id="texte"  rows="2" class="font-size-14 mb-2 form-control mt-2"
                            style=""
                            placeholder="Saisir la publication ici ..."></textarea>
                    </div>
                    <div>
                        <label for="image" class="btn btn-default btn-sm">
                            <i class="fas fa-file-image text-warning"></i>
                            <small><b>Joindre une image ou photo</b></small>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" style="width: 0; height: 0; outline: none;">

                        <button type="submit" style="background-color: #e66937;"
                        class="btn pl-3 pr-3 font-size-14 float-right text-light">
                            Partager
                        </button>
                    </div>
                </form><br />

                @forelse (App\Publication::orderByDesc('id')->get() as $publication)    
                    <!-- Box Comment -->
                    <div class="card card-widget font-size-14">
                        <div class="card-header">
                            <div class="user-block">
                                @foreach (App\User::where('id', $publication->user_id)->get() as $user)
                                    <img class="img-circle" style="border: 2px solid #CCC; padding: 2px;"
                                    src="{{ URL::asset('db/avatar/' . $user->avatar) }}" alt="User Image">
                                    
                                    <div class="dropdown">
                                        <a class="users-list-name font-size-13" style="padding-left: 10px;" href="#" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"><b class="text-primary">{{ $user->name }}</b></a>

                                        <div class="dropdown-menu dropdown-menu-right font-size-13" aria-labelledby="triggerId">
                                            <h6 class="dropdown-header font-size-13">{{ $user->name }}</h6>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('uProfil', $user->id) }}">Profil de {{ $user->name }}</a>
                                            <a class="dropdown-item" href="{{ route('uMessage', $user->id) }}">
                                                Envoyer un message
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                                <span class="description">Publié à {{ substr($publication->created_at, 11, 5) }} le
                                    {{ substr($publication->created_at, 8, 2) }} / {{ substr($publication->created_at, 5, 2) }} /
                                    {{ substr($publication->created_at, 0, 4) }}
                                </span>
                            </div>
                            <!-- /.user-block -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool mt-2">
                                    <i class="fas fa-globe-africa"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            @if ($publication->image != "")
                                <p><img class="img-fluid pad rounded" width="100%" src="{{ URL::asset($publication->image) }}" alt="{{$publication->image}}"></p>
                            @endif

                            @if ($publication->texte != "")
                                <p>
                                    @if (strlen($publication->texte) > 100)
                                        {{ $publication->texte }}
                                    @else
                                        <h3>{{ $publication->texte }}</h3>
                                    @endif
                                </p>
                            @endif

                            @if (count(App\JaimePublication::where('publication_id', $publication->id)->where('user_id', session()->get('id'))->get()) == 0)
                                <a href="{{ route('jaimePublication', $publication->id) }}" class="btn btn-default btn-sm">
                                    <i class="far fa-heart"></i>
                                    @if (count(App\JaimePublication::where('publication_id', $publication->id)->get()) != 0)
                                        {{ count(App\JaimePublication::where('publication_id', $publication->id)->get()) }}
                                    @endif
                                    J'aime
                                </a>
                            @else    
                                <a class="btn btn-default btn-sm">
                                    <i class="fa fa-heart text-danger"></i>
                                    @if (count(App\JaimePublication::where('publication_id', $publication->id)->get()) != 0)
                                        {{ count(App\JaimePublication::where('publication_id', $publication->id)->get()) }}
                                    @endif
                                    J'aime
                                </a>
                            @endif
        
                            <span class="float-right text-muted font-size-13">
                                <a href="{{ route('publication', $publication->id) }}" class="text-muted">
                                    <i class="fa fa-comments" aria-hidden="true"></i>
                                    {{ count(App\Commentaire::where('publication_id', $publication->id)->get()) }} commentaires
                                </a>
                            </span>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer card-comments font-size-13">
                            @foreach (App\Commentaire::where('publication_id', $publication->id)->orderByDesc('id')->limit(3)->get() as $commentaire)    
                                <div class="card-comment">
                                    <!-- User image -->
                                    @foreach (App\User::where('id', $commentaire->user_id)->get() as $user_comment) 
                                        <img class="img-circle img-sm" style="border: 2px solid #CCC; padding: 1px;"
                                        src="{{ URL::asset('db/avatar/' . $user_comment->avatar) }}" alt="User Image">
                
                                        <div class="comment-text">
                                            <span class="username">
                                                {{ $user_comment->name }}
                                                <span class="text-muted float-right">
                                                    {{ substr($commentaire->created_at, 11, 5) }} le
                                                    {{ substr($commentaire->created_at, 8, 2) }} / {{ substr($commentaire->created_at, 5, 2) }} /
                                                    {{ substr($commentaire->created_at, 0, 4) }}
                                                </span>
                                            </span><!-- /.username -->
                                            {{ $commentaire->texte }}
                                        </div>
                                    @endforeach
                                    <!-- /.comment-text -->
                                </div>
                            @endforeach
                            
                        </div>
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <form action="{{ route('storeComment', [$publication->id, $publication->user_id]) }}" method="post">
                                @csrf
                                <img class="img-fluid img-circle img-sm" style="border: 2px solid #CCC; padding: 1px;"
                                src="{{ URL::asset('db/avatar/' . session()->get('avatar')) }}" alt="Alt Text">
                                <!-- .img-push is used to add margin to elements next to floating images -->
                                <div class="img-push">
                                    <input type="text" required autocomplete="off" class="form-control form-control-sm" name="texte" style="border-radius: 15px;"
                                        placeholder="Entrée pour poster le commentaire">
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                @empty
                    <div class="text-center">
                        <br /><br /><br />
                        <h1><i class="fas fa-globe-africa fa-4x text-muted"></i></h1>
                    </div>
                @endforelse

            </div>
            <div class="col-md-3 xs-hide"><br /><br />
                <div class="card mt-3">
                    <div style="overflow: hidden; position: fixed; width: 24.5%; bottom: 0; border-left: 1px solid #CCC; top: 60px;">
                        <div class="card-header">
                            <small>PUBLICITÉS ET ANNONCES</small>
                        </div>
                        <div class="card-body">
                            <div id="carouselId" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselId" data-slide-to="1"></li>
                                    <li data-target="#carouselId" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="{{ URL::asset('db/publicites/image.png') }}" class="rounded" width="100%" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL::asset('db/publicites/01.jpg') }}" class="rounded" width="100%" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ URL::asset('db/publicites/02.jpg') }}" class="rounded" width="100%" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>


                        <div class="card" style="margin: 0 20px;">
                            <div class="card-header font-size-13">
                                
                                QESLQUES UNS DES MEMBRES
          
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @forelse (App\User::where('id', '<>', session()->get('id'))->orderByDesc('id')->limit(8)->get() as $membre)
                                        <li>
                                            <div class="dropdown">
                                                <a  href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                        <img src="{{ URL::asset('db/avatar/' . $membre->avatar) }}" alt="User Image"
                                                        style="border: 2px solid #CCC; padding: 2px;">
                                                        <a class="users-list-name font-size-13">{{ $membre->name }}</a>
                                                </a>
                                                <div class="dropdown-menu font-size-13" aria-labelledby="triggerId">
                                                    <a class="dropdown-item" href="{{ route('uProfil', $membre->id) }}">Profil de {{ $membre->name }}</a>
                                                    <a class="dropdown-item" href="{{ route('uMessage', $membre->id) }}">Envoyer un message</a>
                                                </div>
                                            </div>
                                            
                                        </li> 
                                    @empty
                                        <div class="text-center font-size-14"><br />
                                            <i class="fa fa-users" aria-hidden="true"></i><br />
                                            Pas plus de membres !
                                        </div>
                                    @endforelse
                                </ul>
                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center font-size-13">
                                <a href="javascript::">Découvrir plus de membres (...)</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('uPublier') }}" class="btn font-size-14 pl-3 pr-3 text-light"
    style="border-radius: 25px; position: fixed; right: 15px; bottom: 15px; background-color: #e66937;">
        <i class="fas fa-globe-africa"></i>
        Publier
    </a>
@endsection

@section('js')
    
@endsection