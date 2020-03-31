<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item" id="main"><a href="{{route('main')}}"><i class="la la-home"></i><span class="menu-title">Home</span></a></li>

        <li class="nav-item" id="customer">
            <a href="{{route('customer.index')}}"><i class="icon-layers"></i><span class="menu-title">Clientes</span></a>
        </li>

        <li class="nav-item" id="catalog">
            <a href={{route('catalog.index')}}#"><i class="icon-layers"></i><span class="menu-title">Catálogo</span></a>
        </li>

        <li class="nav-item" id="order">
            <a href={{route('order.index')}}#"><i class="ft-shopping-cart"></i><span class="menu-title">Vendas</span></a>
            <ul class="menu-content">
                <li><a href="{{route('order.index')}}"><span class="menu-title">Meus pedidos</span></a></li>
                <li><a href="{{route('order.pdv')}}"><span class="menu-title">PDV</span></a></li>
            </ul>
        </li>

        <li class="division"><hr></li>

        <li class=" nav-item" id="main"><a href="{{route('auth.logoff')}}"><i class="la la-power-off"></i><span class="menu-title">Sair do sistema</span></a></li>

    </ul>
</div>
