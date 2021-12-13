<header class="page-header">
    <h2 class="page-header-title">{{ $pageHeaderTitle }}</h2>

    <form action="{{ route('logout') }}" method="POST" class="page-header-logout">
        @csrf
        <button class="btn-component" type="submit">Sair</button>
    </form>
</header>
