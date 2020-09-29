<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Projeto') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{URL::to('js/checkout.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::to('dist/css/cartao.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Projeto') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a class="nav-link" href="{{ url('produtos')}}">{{ __('Produtos') }}</a>
                       </li>
                       <li><a class="nav-link" href="{{ url('contato')}}">{{ __('Contato') }}</a>
                       </li>
                   </ul>

                   <!-- Right Side Of Navbar -->
                   <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                    </li>
                    @endif
                    @else
                        <li><a class="nav-link" href="{{ url('carrinho')}}">{{ __('Carrinho') }} <span class="badge">{{Session::has('carrinho')?Session::get('carrinho')->qtdTotal:''}}</span></a>

                    <li><a class="nav-link" href="{{ url('produtos')}}">{{ __('Inserir Produtos') }}</a>
                    </li></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
    </div>
</nav>

<main class="container">
    <div>
        @yield('content')
    </div class = "container">
</main>
</div>
<script type="text/javascript" src="{{URL::to('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('dist/js/bootstrap.min.js')}}"></script>

</body>
</html>
