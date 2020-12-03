<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Desafio - Oliveira Trust') }}</title>
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/select2/css/select2.bootstrap.min.css') }}" rel="stylesheet" />
        @section('style')
        @show
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            @guest
            @else
            <div class="bg-light border-right" id="sidebar-wrapper">
                <div class="sidebar-heading">
                    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-decoration-none" href="{{ url('/') }}">
                        {{ config('app.name', 'Desafio - Oliveira Trust') }}
                    </a>
                </div>
                <div class="list-group list-group-flush">
                    @include('layouts.menu')
                </div>
            </div>
            @endguest

            <div id="page-content-wrapper">

                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    @guest
                    @else
                    <button class="btn btn-light" id="menu-toggle"><i class="fas fa-arrows-alt-h"></i></button>
                    @endguest

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto"></ul>
                        <ul class="navbar-nav ml-auto">
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
                    @if (session('status'))
                    <div id="alert" class="alert alert-{{session('status-type')}} alert-dismissible fade show" role="alert" style="position: absolute; right: 5px; top: 60px; z-index: 10;">
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
                </div>
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

        <!-- Scripts -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
        @section('script')
        @show
        <script src="{{ asset('assets/js/custom.js')}}"></script>
    </body>

</html>
