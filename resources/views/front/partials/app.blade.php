<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <base href="{{ config('app.url') }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/images/favicon.png') }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- Fixed CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('assets/css/app.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('assets/css/styles.css')) }}">

    <!-- Dinamic CSS Files -->
    @stack('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token()
        ]) !!};
    </script>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    @include('front.partials.layout.header')

    <div class="content-body">
        @yield('content')
    </div>

    @include('front.partials.layout.footer')

    <script type="text/javascript" src="{{ asset(mix('assets/js/app.js')) }}"></script>

    @stack('scripts')
</body>
</html>
