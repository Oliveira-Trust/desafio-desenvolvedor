<header class="w-full">
    <nav class="bg-white dark:bg-slate-800">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 py-2.5 md:px-6">
            <a
                href="https://flowbite.com"
                class="flex items-center"
            >
                <img
                    src="https://flowbite.com/docs/images/logo.svg"
                    class="mr-3 h-6 sm:h-9"
                    alt="Flowbite Logo"
                />
                <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">Flowbite</span>
            </a>
            <div
                class="flex items-center"
                x-data="{ userDropdown: false }"
            >
                <div class="relative flex items-center md:order-2">
                    <x-button.circle
                        icon="user"
                        x-on:click="userDropdown = !userDropdown"
                        outline
                        primary
                        sm
                    />
                    <!-- Dropdown menu -->
                    <div
                        x-cloak
                        class="absolute top-10 right-0 z-20 my-4 list-none divide-y divide-slate-100 rounded bg-white text-base shadow after:absolute after:-top-2 after:right-2 after:h-4 after:w-4 after:rotate-45 after:border-l after:border-t after:border-slate-100 after:bg-white dark:divide-slate-600 dark:bg-slate-700 dark:after:border-slate-700 dark:after:bg-slate-700"
                        x-show="userDropdown"
                    >
                        <div class="py-3 px-4">
                            <span class="block text-sm text-slate-900 dark:text-white">
                                {{ auth()->user()->name }}
                            </span>
                            <span
                                class="block truncate text-sm font-medium text-slate-500 dark:text-slate-400">{{ auth()->user()->email }}
                            </span>
                        </div>
                        <ul
                            class="py-1"
                            aria-labelledby="user-menu-button"
                        >
                            <li>
                                <a
                                    x-on:click.prevent="darkMode = !darkMode"
                                    class="block cursor-pointer py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-white"
                                >
                                    <div
                                        x-cloak
                                        x-show="darkMode"
                                        class="flex items-center gap-2"
                                    >
                                        <x-icon
                                            name="sun"
                                            class="h-5 w-5"
                                        />
                                        <span>Modo claro</span>
                                    </div>
                                    <div
                                        x-cloak
                                        x-show="!darkMode"
                                        class="flex items-center gap-2"
                                    >
                                        <x-icon
                                            name="moon"
                                            class="h-5 w-5"
                                        />
                                        <span>Modo escuro</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-white"
                                >Configurações</a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('auth.logout') }}"
                                    class="block py-2 px-4 text-sm text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-600 dark:hover:text-white"
                                >Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="h-10 overflow-hidden border-y border-slate-200 bg-white shadow dark:border-slate-700 dark:bg-slate-800">
        <div class="soft-scrollbar mx-auto h-full max-w-screen-xl overflow-x-auto overflow-y-hidden">

            <ul class="mr-6 flex h-full flex-row space-x-2 px-4 text-sm font-medium md:px-6">
                <li>
                    <x-header-link
                        page="Painel"
                        route="dashboard"
                    />
                </li>
                <li>
                    <x-header-link
                        page="Cotações"
                        route="auth.login.index"
                    />
                </li>
            </ul>

        </div>
    </nav>
</header>
