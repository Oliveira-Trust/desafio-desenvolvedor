<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion " id="accordionSidebar"> <!-- toggled -->
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-text font-black-ops-one" style="font-weight: normal; font-size: 95%;">
        Oliveira Trust
        </div>
        <div class="pl-1">
            <i class="fas fa-money-bill"></i>
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Inicio</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Moedas
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu-cadastros-financeiros" aria-expanded="true" aria-controls="menu-cadastros-financeiros">
            <i class="fas fa-fw fa-list"></i>
            <span>Cadastros</span>
        </a>
        <div id="menu-cadastros-financeiros" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acessar:</h6>
                <a class="collapse-item" href="{{ route('conversoes_moedas.index') }}"><i class="fas fa-exchange-alt"></i> Conversões</a>
            </div>
        </div> 
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu-movimentacoes-financeiros" aria-expanded="true" aria-controls="menu-movimentacoes-financeiros">
            <i class="fas fa-fw fa-list"></i>
            <span>Taxas</span>
        </a>
        <div id="menu-movimentacoes-financeiros" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acessar:</h6>
                <a class="collapse-item" href="{{ route('forma_pagamento_taxas.index') }}"><i class="fas fa-list"></i> Forma de Pagamento</a>
                <a class="collapse-item" href="{{ route('conversao_taxas.index') }}"><i class="fas fa-list"></i> Conversão</a>
            </div>
        </div> 
    </li>
    <li class="nav-item hidden">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu-configuracoes" aria-expanded="true" aria-controls="menu-configuracoes">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Configurações</span>
        </a>
        <div id="menu-configuracoes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acessar:</h6>
                <a class="collapse-item" href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Usuários</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Sistema
    </div>
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('usuarios.meus_dados',Auth::user()->id) }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Meus dados</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Sair</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>