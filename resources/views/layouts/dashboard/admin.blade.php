<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')  - {{config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
</head>

<body>
    <!-- TOP !--->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ url('/dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form method="POST"  class="w-100" action="@yield('search-route')">
    @csrf
    <input class="form-control w-100" type="search" name="search" placeholder="digite sua busca e pressione enter" value="{{old('search')}}" aria-label="Search"/>
  </form>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('Sair') }}
     </a>
    </li>
  </ul>
</nav>
<!-- TOP !--->

<!-- Main Wrapper -->
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('dashboard')}}">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('users.index')}}">
                    <span data-feather="file"></span>
                    Usuários
                  </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('products.index')}}">
                    <span data-feather="shopping-cart"></span>
                    Produtos
                  </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('orders.index')}}">
                    <span data-feather="users"></span>
                    Pedidos
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        <!-- SIDEBAR -->
        <!--MAIN CONTENT -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @yield('content')
        </main>

        <!-- MAIN CONTENT -->
    </div>
</div>

<!-- Main Wrapper -->
</html>
