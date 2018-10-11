<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/js/jquery-ui.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/dataTables.bootstrap.min.css') !!}" >

    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/jquery.ui.1.10.3.ie.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/jquery-ui-1.10.3.custom.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/jquery-ui-1.10.3.theme.css') !!}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin/assets/fonts/font-awesome/css/font-awesome.min.css') !!}">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="{!! asset('admin/assets/css/ionicons.min.css') !!}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin/dist/css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/dist/css/skins/_all-skins.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('admin/assets/css/style.css') !!}">

</head>
<body class="hold-transition skin-blue sidebar-mini">

    @guest
        @include('errors.411')
    @else

        @include('layout-backend.header')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </section>
            </div>

        @include('layout-backend.footer')

            </div><!-- /.content-wrapper -->
        </div>
        
    @endguest

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{!! asset('admin/plugins/jQuery/jQuery-2.1.4.min.js') !!}"></script>
    <script src="{!! asset('admin/assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('admin/dist/js/app.min.js') !!}"></script>
    <script src="{!! asset('admin/assets/js/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('admin/assets/js/dataTables.bootstrap.min.js') !!}"></script>
    <script src="{!! asset('admin/assets/js/jquery-ui-1.10.3.custom.min.js') !!}" type="text/javascript"></script>

    <!-- Javascript untuk datatable -->
    <script type="text/javascript">
       $(document).ready(function() {
            $('#example').DataTable( {
                "scrollY": 450
            });
        } );
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var $lightbox = $('#lightbox');
            
            $('[data-target="#lightbox"]').on('click', function(event) {
                var $img = $(this).find('img'), 
                    src = $img.attr('src'),
                    alt = $img.attr('alt'),
                    css = {
                        'maxWidth': $(window).width() - 100,
                        'maxHeight': $(window).height() - 100
                    };
            
                $lightbox.find('.close').addClass('hidden');
                $lightbox.find('img').attr('src', src);
                $lightbox.find('img').attr('alt', alt);
                $lightbox.find('img').css(css);
            });
            
            $lightbox.on('shown.bs.modal', function (e) {
                var $img = $lightbox.find('img');
                    
                $lightbox.find('.modal-dialog').css({'width': $img.width()});
                $lightbox.find('.close').removeClass('hidden');
            });
        });
    </script>

</body>
</html>
