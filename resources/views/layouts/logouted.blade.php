<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ Config::get('lara-mvcms.site-name') }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link href="{{ asset('/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/AdminLTE/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/bower_components/AdminLTE/plugins/iCheck/square/blue.css')}}" rel="stylesheet" type="text/css" >

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">

        @yield('content')

        <!-- jQuery -->
        <script src="{{ asset('/bower_components/jQuery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- iCheck plugin -->
        <script src="{{ asset('/bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/bower_components/AdminLTE/dist/js/app.min.js') }}" type="text/javascript"></script>
        <!-- CKEditor -->
        <script src="{{ asset('/bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/bower_components/AdminLTE/plugins/ckeditor/adapters/jquery.js') }}" type="text/javascript"></script>
        <!-- LaraMvcms App -->
        <script src="{{ asset('/vendor/lara-mvcms/js/admin.js') }}" type="text/javascript"></script>
    </body>
</html>
