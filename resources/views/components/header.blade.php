<header class="w-full">
    <nav class="bg-white dark:bg-gray-800">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 py-2.5 md:px-6">
            <a
                href="{{ route('dashboard') }}"
                class="flex flex-col items-start justify-center gap-2"
            >
                <x-app-logo class="h-6" />
                <span class="text-sm font-light">Desenvolvedor PHP (Jr/Pleno/Sênior)</span>
            </a>
            <div
                class="flex items-center"
                x-data="{ userDropdown: false }"
            >
                <div class="relative flex items-center gap-3 md:order-2">
                    <span class="hidden text-sm font-bold sm:inline-block">
                        {{ auth()->user()->name }}
                    </span>
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
                        class="absolute top-10 right-0 z-20 my-4 list-none divide-y divide-gray-100 rounded bg-white text-base shadow after:absolute after:-top-2 after:right-2 after:h-4 after:w-4 after:rotate-45 after:border-l after:border-t after:border-gray-100 after:bg-white dark:divide-gray-600 dark:bg-gray-700 dark:after:border-gray-700 dark:after:bg-gray-700"
                        x-show="userDropdown"
                    >
                        <div class="py-3 px-4">
                            <span class="block text-sm text-gray-900 dark:text-white">
                                {{ auth()->user()->name }}
                            </span>
                            <span
                                class="block truncate text-sm font-medium text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}
                            </span>
                        </div>
                        <ul class="py-1">
                            <li>
                                <a
                                    x-on:click.prevent="darkMode = !darkMode"
                                    class="block cursor-pointer py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
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
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                >Configurações</a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('auth.logout') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                >Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <x-header-menu />
</header>
