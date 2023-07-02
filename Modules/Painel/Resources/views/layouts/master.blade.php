<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Painel</title>

       {{-- Laravel Mix - CSS File --}}
       {{-- <link rel="stylesheet" href="{{ mix('css/painel.css') }}"> --}}

        <!-- bootstrap.css -->
        <link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.min.css')}}">

        <!--NavBar  -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!--div class="container-fluid"-->
            <a class="navbar-brand" href="{{URL::to('/painel')}}" id="home">
                <i class="fa-solid fa-house fa-lg"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @auth
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{URL::to('/painel/conversor-painel')}}" >Conversor Moedas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{URL::to('/painel/listagem-conversao')}}" >Listagem Conversões</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{URL::to('/painel/formas-pagamento')}}" >Formas de Pagamento</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ URL::to('/logout')}}">
                        @csrf
                        <a class="nav-link" href="{{ URL::to('/logout')}}" onclick="event.preventDefault();this.closest('form').submit();">{{"(".auth()->user()->name.")"??""}} Sair</a>
                    </form>
                </li>
                @endauth
                
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/register')}}">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/login')}}">Entrar</a>
                </li>
                @endguest
                
                <!-- <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            </div>
        <!--/div-->
        </nav>

    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        {{-- <script src="{{ mix('js/painel.js') }}"></script> --}}
        {{-- <script src="{{asset('js/bootstrap/bootstrap.bundle.min.js')}}"></script> --}}

        <script src="{{asset('js/main.js')}}"></script>

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
        
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    </body>


    <!-- <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Conversor de Moedas Laravel 9 - {{date('d/m/Y')}}</span>
    </div>
    </footer> -->
</html>
