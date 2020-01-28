@extends('layouts.header')

@section('content')
    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 68px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-lg-2 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 font-size-13">
                @foreach (App\Transaction::where('id', $id)->get() as $transaction)    
                    <div class="font-weight-bold text-center pt-2 pb-2 rounded" style="border-top: 2px solid blue; background-color: #FFF;">TRANSACTION {{ $transaction->created_at }}</div><br />
                    @foreach (App\User::where('id', $transaction->id_env)->get() as $user)
                        <div class="text-left">
                            Expéditeur : <b>{{ $user->name }}</b>
                        </div>
                        <div class="text-left">
                            Montant : <b>{{ $transaction->monant }} uryas</b>
                        </div>
                    @endforeach<br />
                    <div class="text-left">
                        <form action="#!" id="receptionForm">
                            <label for="cle">
                                <i class="fa fa-lock text-danger" aria-hidden="true"></i>
                                Clé privée
                            </label>
                            <input type="text" autocomplete="off" required class="form-control font-size-13" id="cle_privee" name="cle" placeholder="Saisir la clé privée ici ...">
                            <button type="submit" id="rcpBtn" class="btn font-size-13 pt-2 pb-2 mt-2 btn-block text-light" style="background-color: #e66937;">
                                Soumettre
                            </button>
                        </form>
                    </div>
                    <div id="receptionContainer" class="text-center">
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#receptionForm').submit(function(e) {
            e.preventDefault();
            $.ajax( {
                type: "GET",
                url : "{{ route('receptionForm') }}",
                data : "key=" + $('#cle_privee').val() + "&transaction=" + "{{ $id }}",
                success : function (status) {
                    $('#receptionContainer').html(status);
                }
            });
        });
    </script>
@endsection