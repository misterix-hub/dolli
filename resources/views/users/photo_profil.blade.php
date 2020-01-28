@extends('layouts.header')

@section('content')

    @include('included.users.app_bar')

    <div class="container-fluid" style="margin-top: 70px;">
        <div class="row">
            @include('included.users.profile_side_bar')
            <div class="col-md-2 col-sm-12">
            </div>
            <div class="col-md-4 col-sm-12 font-size-14">

                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-pills" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Couverture</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                
                                <h3 class="text-center">Photo de profil</h3>

                                <div class="text-center">
                                    <img src="{{ URL::asset('db/avatar/' . session()->get('avatar')) }}" class="rounded-circle" style="border: 2px solid #CCC; padding: 2px;" width="100" alt="">
                                </div><br /><br />

                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input" id="upload_image" name="upload_image">
                                        <label class="custom-file-label" for="exampleInputFile">Sélectionner le fichier</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text font-size-13" id="">Upload</span>
                                    </div>
                                </div><br />

                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                                
                                <h3 class="text-center">Photo de couverture</h3>

                                <img src="{{ URL::asset('db/covers/' . session()->get('couverture')) }}" width="100%" alt="">
                                <br /><br /><br />

                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*" class="custom-file-input" id="upload_image_couverture" name="upload_image_couverture">
                                        <label class="custom-file-label" for="exampleInputFile">Sélectionner le fichier</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text font-size-13" id="">Upload</span>
                                    </div>
                                </div><br />

                            </div>
                        </div>
                    </div>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Rogner la photo de profil</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="image_demo"></div>

                                <div class="text-center mb-3">
                                    <button type="submit" class="crop_image btn bg-gradient-primary font-size-14 pl-4 pr-4">
                                        <i class="fas fa-save"></i>
                                        Rogner et enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="modelCouvertureId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Rogner la photo de couverture</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="image_demo_couverture"></div>

                                <div class="text-center mb-3">
                                    <button type="submit" class="crop_image_couverture btn bg-gradient-primary font-size-14 pl-4 pr-4">
                                        <i class="fas fa-save"></i>
                                        Rogner et enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 150,
                height: 150,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on("change", function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log("ok");
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#modelId').modal('show');
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "{{ URL::asset('upload.blade.php') }}",
                    type: "POST",
                    data: {"image" : response, "id" : "{{ session()->get('id') }}"},
                    success: function (data) {
                        $('#modelId').modal('hide');
                        
                        window.location = "{{ route('successAvatar') }}";
                        
                    }
                });
            });
        });





        $image_crop_couverture = $('#image_demo_couverture').croppie({
            enableExif: true,
            viewport: {
                width: 300,
                height: 110,
                type: 'square'
            },
            boundary: {
                width: 320,
                height: 200
            }
        });

        $('#upload_image_couverture').on("change", function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop_couverture.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log("ok");
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#modelCouvertureId').modal('show');
        });

        $('.crop_image_couverture').click(function (event) {
            $image_crop_couverture.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "{{ URL::asset('upload0.blade.php') }}",
                    type: "POST",
                    data: {"image_couverture" : response, "id" : "{{ session()->get('id') }}"},
                    success: function (data) {
                        $('#modelCouvertureId').modal('hide');

                        console.log(data);
                        
                        
                        window.location = "{{ route('successCover') }}";
                        
                    }
                });
            });
        });
    </script>
@endsection
