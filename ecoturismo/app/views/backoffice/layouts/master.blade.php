<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrador</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{ asset('/backoffice/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ asset('/backoffice/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset('/backoffice/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ asset('/backoffice/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ asset('/backoffice/css/Admin.css') }}" rel="stylesheet" type="text/css" />
        <!-- Alertify -->
        <link href="{{ asset('/backoffice/css/alertify/alertify.core.css') }}" rel="stylesheet" type="text/css" />        
        <link href="{{ asset('/backoffice/css/alertify/alertify.default.css') }}" rel="stylesheet" type="text/css" />
        <!-- Switch -->
        <link href="{{ asset('/backoffice/css/switch/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />  

        {{ HTML::style('/backoffice/css/app/style.css') }}

        @yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        @include('backoffice.layouts.header')
        <div class="wrapper row-offcanvas row-offcanvas-left">
            @include('backoffice.layouts.menu')

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('section')
                        <small>Panel de control</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        @yield('breadcrumb')
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="{{ asset('/backoffice/js/jquery-ui-1.10.3.min.js" type="text/javascript') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/backoffice/js/bootstrap.min.js" type="text/javascript') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('/backoffice/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/backoffice/js/AdminLTE/app.js') }}" type="text/javascript"></script>
        <!-- Alertify -->
        <script src="{{ asset('/backoffice/js/plugins/alertify/alertify.min.js') }}" type="text/javascript"></script>
        <!-- Switch -->
        <script src="{{ asset('/backoffice/js/plugins/switch/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- APP -->
        <script src="{{ asset('/backoffice/js/app/app.js') }}" type="text/javascript"></script>

        @yield('scripts')

        @include('backoffice.layouts.flash')
    </body>
</html>