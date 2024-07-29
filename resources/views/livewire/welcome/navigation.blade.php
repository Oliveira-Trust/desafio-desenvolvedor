<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->dispatch('userLoggedOut');
        $this->render();
    }
}; ?>

<nav class="-mx-3 flex flex-1 justify-end gap-x-1.5">
    @auth
        <div class="flex gap-x-3">
            <button wire:click="logout"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-base-red">
                {{ __('Log Out') }}
            </button>

            <a href="{{route('profile')}}" wire:navigate
               class="cursor-pointer rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-base-red">
                {{ __('Profile') }}
            </a>
        </div>
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
