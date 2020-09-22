<!DOCTYPE html>
<html>
<head>
    <title>OliveiraStore @yield('pagina_titulo')</title>

    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"
          media="screen,projection">
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
                <li><a href="{{ route('admin.produtos') }}">Produtos</a></li>
                <li><a href="{{ route('admin.pedidos') }}">Pedidos</a></li>
                <li><a href="{{ route('admin.clientes') }}">Clientes</a></li>
                <li><a href="{{ route('index') }}">Sair</a></li>
            </ul>
        </div>
    </nav>
</header>
<main>
    @yield('pagina_conteudo')

    @if(!Auth::guest())
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hide">
            @csrf
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
    $(document).ready(function () {
        $(".button-collapse").sideNav();
        $('select').material_select();
    });
</script>
</body>
</html>