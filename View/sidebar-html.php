<?php include __DIR__ . '/header.php'; ?>

<body>
    <!-- LOGO -->
    <div class="logo-box">
        <a href="principal" class="logo text-center">
            <span class="logo-lg">
                <img src="assets/images/favicon_ot.png" alt="" height="48">
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo.png" alt="" height="48">
            </span>
        </a>
    </div>

    <div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>
    </div>
    <!-- end Topbar -->

    <div class="left-side-menu">

        <div class="slimscroll-menu">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navegação</li>
                    <li>
                        <a href="/principal">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> Home </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-google-pages"></i>
                            <span> CRUD Cliente </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="novo-cliente">Cadastrar Cliente</a></li>
                            <li><a href="listar-clientes">Listar Clientes</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-google-pages"></i>
                            <span> CRUD Produto </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="novo-produto">Cadastrar Produto</a></li>
                            <li><a href="listar-produtos">Listar Produto</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-google-pages"></i>
                            <span> CRUD Compra </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="novo-compra">Cadastrar Compra</a></li>
                            <li><a href="listar-compras">Listar Compra</a></li>
                        </ul>
                    <li>

                    <li>
                        <a href="logout">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> logout </span>
                        </a>
                    </li>

                </ul>
            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
