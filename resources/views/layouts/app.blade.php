<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Desafio Desenvolvedor - Oliveira Trust') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        @section('style')
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontawesome/all.min.css') }}" rel="stylesheet">
        @show
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">
                    {{ config('app.name', 'Desafio Desenvolvedor - Oliveira Trust') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                @guest
                <main role="main" class="col-12">
                    @else
                    @include('layouts.menu')

                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-1">
                        @endguest

                        @if (session('status'))
                        <div class="alert alert-{{session('status-type')}} alert-dismissible fade show" role="alert"
                            style="position: absolute; right: 5px; top: 60px; z-index: 10;">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <div class="container-fluid">
                                @yield('content')
                            </div>
                        </div>
                    </main>
            </div>
        </div>

        <!-- Modal Default Restore -->
        <div id="restore-modal" class="modal fade" tabindex="-1" role="dialog">
            {!! Form::open(['id' => 'frm-restore', 'method' => 'put', 'url' => '']) !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Restore record')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Do you want to restore?') }}</p>
                    <input type="text" id="record-name" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="btn-restore" type="button" class="btn btn-primary">{{ __('Restore') }}</button>
                </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <!-- Modal Default Delete -->
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog">
            {!! Form::open(['id' => 'frm-delete', 'method' => 'delete', 'url' => '']) !!}
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete record')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Do you want to delete?') }}</p>
                    <input type="text" id="record-name-delete" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button id="btn-delete" type="button" class="btn btn-primary">{{ __('Delete') }}</button>
                </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        @section('script')
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script>
            $(".restore").on("click", function (event) {
                event.preventDefault();
                $("#record-name").val($(this).attr('data-name'));
                $("#frm-restore").attr("action", $(this).attr("data-route"));
            });

            $("#btn-restore").on("click", function () {
                $(this).prop('disabled', true).html('Aguarde...');
                $('#frm-restore').submit();
            });

            $(".delete").on("click", function (event) {
                event.preventDefault();
                $("#record-name-delete").val($(this).attr('data-name-delete'));
                $("#frm-delete").attr("action", $(this).attr("data-route-delete"));
            });

            $("#btn-delete").on("click", function () {
                $(this).prop('disabled', true).html('Aguarde...');
                $('#frm-delete').submit();
            });

            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        </script>
        @show
    </body>

</html>
