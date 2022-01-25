<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Oliveira Trust - Desafio</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <style>
        body {
            background-color: #e5e5e5;
        }

        nav {
            background-color: white;
            display: flex !important;
            align-items: center;
            justify-content: space-around;
            min-height: 6vh;
            -webkit-box-shadow: 4px 4px 12px -3px #000000;
            box-shadow: 4px 4px 12px -3px #000000;
        }

        #titulo {
            font-size: 25px !important;
        }
    </style>

</head>
<body>
    <div id="app">
        {{-- Header --}}
        <nav>
            <a id="titulo" href="{{ url('/') }}"> Oliveira Trust - Desafio </a>
            <div class="user">
                {{ Auth::user()->name }} | <a href="{{ url('/logout') }}">Logout</a>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

