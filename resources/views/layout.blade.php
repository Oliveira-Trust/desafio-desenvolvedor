<!DOCTYPE html>
<html>
<head>
    <title>OliveiraStore @yield('pagina_titulo')</title>

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" media="screen,projection">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link href="/css/styles.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="nav-wrapper red row">
                <a href="{{ route('index') }}" class="brand-logo col offset-l1">OliveiraStore</a>
                <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{ route('carrinho.compras') }}">Meus Pedidos</a></li>
                    <li><a href="{{ route('carrinho.index') }}">Carrinho</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Entrar</a></li>
                        <li><a href="{{ url('/register') }}">Cadastre-se</a></li>
                    @else
                        <li>
                            <a class="dropdown-button" href="#!" data-activates="dropdown-user">
                                Olá {{ Auth::user()->name }}!<i class="material-icons right">arrow_drop_down</i>
                            </a>
                            <ul id="dropdown-user" class="dropdown-content">
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ route('admin.produtos') }}">Admin</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('pagina_conteudo')

        @if(!Auth::guest())
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hide">
                {{ csrf_field() }}
            </form>
        @endif
    </main>

    <footer class="page-footer red">
        <div class="footer-copyright">
            <div class="container center-align">
                Desafio Para <b>OliveiraTrust</b>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    @stack('scripts')
    <script type="text/javascript">
        $( document ).ready(function(){
            $(".button-collapse").sideNav();
            $('select').material_select();
        });
    </script>
</body>
</html>