<nav class="h-10 border-y border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
    <div class="soft-scrollbar mx-auto h-full max-w-screen-xl">

        <div class="mr-6 flex h-full flex-row space-x-2 px-4 text-sm font-medium md:px-6">
            <x-header-link
                label="Painel"
                route="dashboard"
                route-is="dashboard"
            />
            <x-header-link
                label="Cotações"
                route="quotations.index"
                route-is="quotations.*"
            />
        </div>
    </div>
</nav>
