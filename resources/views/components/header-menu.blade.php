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
                        page="Usuários"
                        route="users.index"
                        route-is="users.*"
                    />
                </li>
                <li>
                    <x-header-link
                        page="Formas de Pagamento"
                        route="payment-method.index"
                        route-is="payment-method.*"
                    />
                </li>
                <li>
                    <x-header-link
                        page="Moedas de Origem"
                        route="source-currencies.index"
                        route-is="source-currencies.*"
                    />
                </li>
                <li>
                    <x-header-link
                        page="Moedas de Destino"
                        route="target-currencies.index"
                        route-is="target-currencies.*"
                    />
                </li>
            @endif
        </ul>

    </div>
</nav>
