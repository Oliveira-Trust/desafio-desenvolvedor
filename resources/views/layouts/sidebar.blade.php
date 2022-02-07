<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Navegação</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('principal') }}">
                    <span data-feather="home"></span>
                    Principal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('historico') }}">
                    <span data-feather="file"></span>
                    Histórico
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('taxa') }}">
                    <span data-feather="file"></span>
                    Taxas
                </a>
            </li>
        </ul>



    </div>
</nav>
