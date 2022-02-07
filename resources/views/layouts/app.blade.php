<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Oliveira Trust</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

    @auth
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    @endauth
</head>

<body>

    @auth
        @include('layouts.header')

        <div class="container-fluid">
            <div class="row">

                @include('layouts.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


                    <div id="app">
                        @yield('conteudo')
                    </div>

                </main>
            </div>
        </div>
    @endauth

    @guest
        @yield('conteudo')
    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
