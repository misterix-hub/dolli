@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div style="position: absolute; top: 50px; right: 0; left: 0; bottom: 0; background-color: #FFF;">
        <div class="container-fluid" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-lg-3 xs-hide p-0" style="height: 100%; overflow: auto; border-right: 1px solid #CCC;">
                    <div class="pt-1 pb-2 pl-3 pr-3 mt-2 border-bottom">
                        <small class="float-right">
                            <i class="fas fa-comment-dots mt-2"></i>
                        </small>
                        <small>DISCUSSION INSTANTANEE</small>
                    </div>

                    <div id="getMessagesBoxContainer">
                        <div class="text-center"><br /><br />
                            <img src="{{ URL::asset('assets/images/30.gif') }}" alt="" width="100">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" style="height: 100%;">
                    <div style="height: 100%; overflow: auto;">
                        <div class="text-center pt-3" style="position: absolute; top: 0; left: 15px; right: 20px; background-color: #FFF;">
                            <small>
                                @foreach (App\User::where('id', $id)->get() as $user_show)
                                    <img src="{{ URL::asset('db/avatar/default.png') }}" alt="" class="rounded-circle"
                                    style="border: 2px solid #CCC; padding: 2px;" width="40"><br />
                                    <b>{{ $user_show->name }}</b>
                                @endforeach
                            </small>
                        </div>
                        <div class="mt-5 pt-5"></div>
                        <table width="100%" id="tableMessages">
                            <tr>
                                <td class="text-center"><br />
                                    <img src="{{ URL::asset('assets/images/30.gif') }}" alt="" width="100">
                                </td>
                            </tr>
                        </table>

                                
                        <br /><br /><br /><br />
                        @if ($id != session()->get('id'))
                            <div style="position: absolute; bottom: 15px; left: 15px; right: 20px;" class="pt-4">
                                <table width="100%">
                                    <tr>
                                        <td class="pr-2 pl-1">
                                            <input type="text" name="texte" id="texte" class="form-control font-size-14"
                                            style="border-radius: 20px; border: 1px solid #AAA;" placeholder="Entrée pour envoyer le message ...">
                                        </td>
                                        <td width="40" class="pr-1">
                                            <button type="submit" id="storeMessageBtn" class="btn bg-gradient-primary rounded-circle" style="width: 40px; height: 40px; padding-left: 10px;">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 xs-hide" style="height: 100%; border-left: 1px solid #CCC;">

                    @foreach (App\User::where('id', $id)->get() as $user_rcp)    
                        <div class="pt-3 pt-2 text-center">
                            <small>EN DICUSSION AVEC {{ $user_rcp->name }}</small>
                        </div>
                        <div class="text-center mt-3">
                            <img class="img-circle" style="border: 2px solid #CCC; padding: 2px;"
                                src="{{ URL::asset('db/avatar/' . $user_rcp->avatar) }}" alt="User Image" width="100">

                            <h3 class="mt-2">{{ $user_rcp->name }}<br />{{ $user_rcp->profession }}</h3>
                        </div><br />
                        <div class="font-size-14 pl-2" style="line-height: 25px;">
                            <i class="fa fa-briefcase text-success" aria-hidden="true"></i>
                            Formaion | Emploi: Étudiant<br />
                            <i class="fas fa-map-marker-alt text-danger" aria-hidden="true"></i>
                            Lieu de résidence : Lomé, Togo.
                        </div><br /><br />
                        @endforeach
                        <div class="text-center">
                            <a href="{{ route('uIndex') }}" class="btn bg-gradient-primary pl-4 pr-4 font-size-14">
                                Retour à l'accueil
                            </a>
                        </div>

                </div>
            </div>
        </div>
       
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#storeMessageBtn').click(function() {
                if ($('#texte').val().trim() != "") {
                    $.ajax( {
                        type : "GET",
                        url : "{{ route('uStoreMessage') }}",
                        data : "texte=" + $('#texte').val() + "&dest_id= {{ $id }}",
                        success : function (status) {
                            $('#texte').val("");
                        }
                    });
                }
            });

            setInterval(() => {
                $.ajax( {
                    type : "GET",
                    url : "{{ route('getMessages') }}",
                    data : "user_id={{ $id }}",
                    success : function (status) {
                        $('#tableMessages').html(status);
                    }
                });
            }, 1000);

            setInterval(() => {
                $.ajax( {
                    type : "GET",
                    url : "{{ route('getMessagesBox') }}",
                    data : "user_id={{ $id }}",
                    success : function (status) {
                        $('#getMessagesBoxContainer').html(status);
                    }
                });
            }, 3000);
        });
    </script>
@endsection