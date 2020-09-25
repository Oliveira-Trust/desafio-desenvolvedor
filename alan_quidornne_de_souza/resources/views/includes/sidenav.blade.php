

<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
   <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
         <a class="navbar-brand" href="javascript:void(0)">
         <img src="{{ asset('img/brand/logooliveiratrust.png') }}" class="navbar-brand-img" alt="Oliveira Trust">
         </a>
      </div>
      <div class="navbar-inner">
         <!-- Collapse -->
         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href=" {{ route('home') }} ">
                     <i class="ni ni-tv-2 text-primary"></i>
                     <span class="nav-link-text">Dashboard</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ (in_array(Route::currentRouteName(), ['manterClientes','filtrarClientes']) ? 'active' : '') }}" href="{{ route('manterClientes') }}">
                     <i class="ni ni-single-02 text-primary"></i>
                     <span class="nav-link-text">Clientes</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ (in_array(Route::currentRouteName(), ['manterProdutos','filtrarProdutos']) ? 'active' : '') }}" href="{{ route('manterProdutos') }}">
                     <i class="ni ni-collection text-primary"></i>
                     <span class="nav-link-text">Produtos</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link {{ (in_array(Route::currentRouteName(), ['manterPedidos','filtrarPedidos']) ? 'active' : '') }}" href="{{ route('manterPedidos') }}">
                     <i class="ni ni-cart text-primary"></i>
                     <span class="nav-link-text">Pedidos</span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>