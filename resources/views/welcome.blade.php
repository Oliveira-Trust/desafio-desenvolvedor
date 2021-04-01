<!doctype html>
<html lang="en">
  <head>
   <meta charset="UTF-8">
        
        <title>Teste Oliveira Trust - Pedidos Online</title>
    <link href="/css/app.css" rel="stylesheet">
      
  </head>
  <body>
    
        <div class="container">
  
       <header class="d-flex flex-wrap justify-content-center py-12 mb-12 border-bottom">


    <ul class="nav nav-pills">
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
      <li class="nav-item"><a href="/" class="nav-link active">Home</a></li>
       <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pedidos</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('inserir_pedido') }}">Inserir Pedidos</a>
                  <a class="dropdown-item" href="{{ route('listar_pedidos') }}">Listar Pedidos</a>
                </div>
      </li>
      <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Produtos</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('listar_produtos') }}">Listar Produtos</a>
                  <a class="dropdown-item" href="{{ route('cadastrar_produto') }}">Cadastrar Produtos</a>
                </div>
      </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Clientes</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('listar_clientes') }}">Listar Clientes</a>
                  <a class="dropdown-item" href="{{ route('inserir_cliente') }}">Cadastrar Clientes</a>
                </div>
      </li>
      
                        <!-- Authentication Links -->
                        
                        
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
    
  </header>
                @yield('content')
        </div>
      
    <script src="/js/app.js"></script>
  </body>
</html>

