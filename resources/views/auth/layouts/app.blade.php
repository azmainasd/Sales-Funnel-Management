<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Log in</title>
        {{-- Title icon --}}
        <link rel="icon" type="image/png" sizes="50x50" href="{{ asset('admin-item/dist/img/shebaTitle.png') }}">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('admin-item/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('admin-item/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('admin-item/dist/css/adminlte.min.css') }}">
        {{-- <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script> --}}

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        @include('auth.layouts.css')

    </head>

    <body class="hold-transition login-page">

        @section('main-content')
        @show

        <!-- jQuery -->
        <script src="{{ asset('admin-item/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('admin-item/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('admin-item/dist/js/adminlte.min.js') }}"></script>

    </body>

</html>