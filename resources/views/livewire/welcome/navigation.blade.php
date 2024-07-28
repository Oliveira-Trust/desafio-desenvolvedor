<nav class="-mx-3 flex flex-1 justify-end gap-x-1.5">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-base-red"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md text-zinc-800 px-3 py-2 ring-1 ring-transparent transition hover:text-base-red duration-300 ease-in-out focus:outline-none focus-visible:ring-base-red"
        >
            Entrar
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="base-button"
            >
                Criar conta
            </a>
        @endif
    @endauth
</nav>
