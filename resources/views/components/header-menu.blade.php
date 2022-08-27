<nav class="h-10 overflow-hidden border-y border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <div class="soft-scrollbar mx-auto h-full max-w-screen-xl overflow-x-auto overflow-y-hidden">

        <ul class="mr-6 flex h-full flex-row space-x-2 px-4 text-sm font-medium md:px-6">
            <li>
                <x-header-link
                    page="Painel"
                    route="dashboard"
                    route-is="dashboard"
                />
            </li>
            <li>
                <x-header-link
                    page="Cotações"
                    route="quotations.index"
                    route-is="quotations.*"
                />
            </li>
            @if (auth()->user()->admin)
                <li>
                    <x-header-link
                        page="Moedas"
                        route="currencies.index"
                        route-is="currencies.*"
                    />
                </li>
            @endif
        </ul>

    </div>
</nav>
