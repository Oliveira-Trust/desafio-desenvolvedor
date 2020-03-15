<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>:: {{config('app.name')}} :: @yield('title') </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('product.products')}}">Produtos</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('product.index')}}">Meus Produtos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('order.index')}}">Meus Pedidos</a>
                </li>


            @endauth
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <li class="nav-item form-inline">
                <a class="btn btn-md btn-outline-primary mr-3" href="{{route('cart.index')}}">Carrinho</a>
            </li>
            @auth
                @if (Auth::user()->access === 'ADMIN')
                    <li class="nav-item form-inline">
                        <a class="btn btn-md btn-success mr-3" href="{{route('order.all')}}">Aprovação de Pedidos</a>
                    </li>
                    <li class="nav-item form-inline">
                        <a class="btn btn-md btn-primary mr-3" href="{{route('user.index')}}">Usuários</a>
                    </li>
                @endif
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="{{route('user.me')}}" class="dropdown-item">Minha Conta</a>
                    <a class="dropdown-item" href="javascript:;" onclick="document.getElementById('logout-form').submit();">Sair</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </div>
            @else
                <a href="{{ route('register') }}" class="btn btn-md btn-outline-success mr-1">Cadastrar-se</a>
                <a href="{{route('login')}}" class="btn btn-md btn-outline-primary">Entrar</a>
            @endauth
        </div>
    </div>
</nav>

@yield('content')

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-modal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="save">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/maskMoney.js')}}"></script>
@yield('scripts')
</body>
</html>
