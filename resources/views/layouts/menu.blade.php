<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item has-treeview {{ Request::is('cotacao-preco', 'cotacao-preco.index') ? 'menu-is-opening menu-open' : '' }}">
    <a href="{{ route('cotacao-preco.index') }}" class="nav-link {{ Request::is('cotacao-preco', 'cotacao-preco.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-dollar-sign"></i>
        <p>Cotação Preço</p>
    </a>
</li>

<li class="nav-item has-treeview {{ Request::is('conversao-taxa', 'conversao-taxa/index') ? 'menu-is-opening menu-open' : '' }}">
    <a href="{{ route('conversao-taxa.index') }}" class="nav-link {{ Request::is('conversao-taxa', 'conversao-taxa/index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-bars"></i>
        <p>Taxas Conversão</p>
    </a>
</li>