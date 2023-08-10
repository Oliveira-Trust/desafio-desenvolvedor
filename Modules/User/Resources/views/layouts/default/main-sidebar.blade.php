<aside class="main-sidebar elevation-1 sidebar-dark-primary">
    <a href="{{ route('site::index') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light"><b>{{ config('app.name') }}</b></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-child-indent nav-pills nav-sidebar flex-column {{--nav-flat--}}" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('conversion::conversion.index') }}" class="nav-link {{ Ekko::isActiveRoute('conversion::conversion.*') }}">
                        <i class="fa fa-money-check nav-icon"></i>
                        <p>Conversões</p>
                    </a>
                </li>
                <li class="nav-header">TAXAS</li>

                <li class="nav-item">
                    <a href="{{ route('conversion::config.payment.edit') }}" class="nav-link {{ Ekko::isActiveRoute('conversion::config.payment.edit') }}">
                        <p>Forma de Pagamento</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('conversion::config.tax.index') }}" class="nav-link {{ Ekko::isActiveRoute('conversion::config.tax.*') }}">
                        <p>Conversão</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
