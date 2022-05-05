@if (Route::has('login'))
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->routeIs('welcome')) active @endif">
                <a class="nav-link" href="{{ route('index') }}">Home</a>
            </li>
            @auth
                <li class="nav-item">
                    <a href="{{ route('exchange.history') }}" class="nav-link">Histórico</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Criar conta</a>
                </li>
                @endif
            @endauth
        </ul>
        @auth
            <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Sair</button>
            </form>
        @endauth
    </div>
</nav>
@endif


