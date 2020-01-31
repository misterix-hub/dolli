<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/croppie/croppie.css') }}">
    @yield('css')
    <title>Dolli</title>
</head>
<body style="" class="sidebar-collapse">

    @yield('content')

    <script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('assets/croppie/croppie.js') }}"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ URL::asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ URL::asset('dist/js/demo.js') }}"></script>
    @yield('js')
    <script>
        $(document).ready(function () {
            
            $('#popoverMessage').click(function () {
                $(this).popover('show');
            });
            $('#popoverNotification').click(function () {
                $(this).popover('show');
            })

            $('#soldeForm').submit(function(e) {
                e.preventDefault();
                if ($('#cle_prv').val().trim() != "") {
                    $('#soldeContainer').html("<img src=\"{{ URL::asset('assets/images/30.gif') }}\" width='100' />");
                    $.ajax( {
                        url : "{{ route('getSolde') }}",
                        data : "key=" + $('#cle_prv').val(),
                        success : function (status) {
                            $('#soldeContainer').html(status);
                        }
                    });
                }
            });

            $('#sendForm').submit(function(e) {
                e.preventDefault();
                if ($('#cle_publique').val() != "" && $('#montant').val() != "") {    
                    $('#envoyerContainer').html("<img src=\"{{ URL::asset('assets/images/30.gif') }}\" width='100' />");
                    $.ajax( {
                        url : "{{ route('destEnvoi') }}",
                        data : "key=" + $('#cle_publique').val() + "&montant=" + $('#montant').val(),
                        success : function (status) {
                            $('#envoyerContainer').html(status);
                            $('#montant').val("");
                        }
                    });
                }
            });
        });
        
        setInterval(() => {
            $.ajax( {
                url : "{{ route('nbNotification') }}",
                success : function (status) {
                    $('small#nbNotification').html(status);
                }
            });
        }, 3000);

        setInterval(() => {
            $.ajax( {
                url : "{{ route('recupNotification') }}",
                success : function (status) {
                    $('#notificationContainer').html(status);
                }
            });
        }, 3000);

        setInterval(() => {
            $.ajax( {
                url : "{{ route('messagesNotifications') }}",
                success : function (status) {
                    $('#messagesNotificationContainer').html(status);
                }
            });
        }, 3000);

        setInterval(() => {
            $.ajax( {
                url : "{{ route('nbMessageNotification') }}",
                success : function (status) {
                    $('small#nbMessageContainer').html(status);
                }
            });
        }, 3000);

    </script>
    
</body>
</html>