<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Cambio App</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap-5.1.3/css/bootstrap.min.css') }}" rel="stylesheet">

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

    <!-- Custom styles for this template -->
    <link href="{{ asset('custom/css/cambio-app.css') }}" rel="stylesheet">

    <script>
        var baseUrl = "{{ url('/') }}";
    </script>
</head>

<body>

    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <span class="fs-4">Cambio App</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ url('/') }}">Cambio</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ url('/historico') }}">Histórico</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{ url('/taxas') }}">Taxas</a>
                </nav>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @yield('content')
            <footer class="pt-4 my-md-5 pt-md-5 border-top">
                <div class="row">
                    <div class="col-12 col-md"></div>
                </div>
            </footer>
            <div id="block" class="modal" data-bs-backdrop="static" tabindex="-1">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content" style="border-color: transparent; background-color: transparent;">
                        <div class="col-md-12 text-center">
                            <div class="spinner-grow" role="status" style="width: 3rem; height: 3rem;">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="/js/app.js"></script>
    <script src="{{ asset('/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') }}"></script>
    @yield('scripts')
</body>

</html>