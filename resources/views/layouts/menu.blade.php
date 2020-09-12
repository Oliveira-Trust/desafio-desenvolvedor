<div id="wrapper">
    <nav class=" navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li  class="clientes">
                    <a> <i class="fa fa-user-plus"></i> <span class="nav-label">Clientes</span></a>
                </li>
                <li  class="produtos">
                    <a  ><i class="fa fa-list"></i> <span class="nav-label">Produtos</span> </a>
                </li>
                <li class="pedidos">
                    <a ><i class="fa fa-opencart"></i> <span class="nav-label">Pedidos</span></a>
                </li>

            </ul>

        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">

        <div class="col-lg-10">
            @yield('title')
        </div>
        <div class="col-lg-2">

        </div>

        @yield('content')

    </div>
</div>
</div>