<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{--  ADMIN LTE  --}}
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/bootstrap/css/bootstrap.min.css') }}">
    
    @yield('styles_default')
    @yield('styles')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('default/navbar')
        @include('default/main_sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('default/footer')
    </div>
    {{--  ADMIN LTE  --}}
    <script src="{{ asset('assets/adminlte3/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button) 
    </script>
    <script src="{{ asset('assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/js/adminlte.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/js/demo.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @yield('javascripts_default')
    @yield('javascripts')
</body>

</html>