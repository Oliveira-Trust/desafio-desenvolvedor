<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Conversão</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="{{ route('conversao.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Conversão</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('historicos.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Histórico</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configuracoes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Configurações</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
