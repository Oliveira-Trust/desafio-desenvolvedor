<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lucas de Oliveira Silva"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    @yield('stylesheets')

    <title>Dashboard</title>
</head>
<body>

@include('includes.sidebar')

@include('includes.header', ['pageHeaderTitle' => $pageHeaderTitle])

<main>
    @yield('content')
</main>

<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
