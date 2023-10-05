<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cahyo Anom | @yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        @include('backend._partials.header')

        @include('backend._partials.sidebar')

        @yield('content')

        @include('backend._partials.footer')

    </div>

    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('assets/dist/js/demo.js') }}"></script>
</body>

</html>