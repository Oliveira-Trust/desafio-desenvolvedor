@push('title', 'Painel')

<x-app-layout>
    <span class="text-base">
        Bem vindo(a), <strong class="font-bold">{{ auth()->user()->name }}</strong>
    </span>
    <div class="mt-2 mb-6"></div>
    <div class="grid grid-cols-12 gap-4">
        <x-dashboard-card
            route="quotations.index"
            class="col-span-12 md:col-span-6 lg:col-span-4"
        >
            <x-slot name="header">
                <div class="flex items-center gap-3">
                    <x-icon
                        name="globe-alt"
                        class="h-10 w-10"
                    />
                    <span class="text-lg">Cotações</span>
                </div>
            </x-slot>
            <x-slot name="footer">
                Veja a lista de cotações realizadas
            </x-slot>
        </x-dashboard-card>
        @if (auth()->user()->admin)
            <x-dashboard-card
                route="payment-methods.index"
                class="col-span-12 md:col-span-6 lg:col-span-4"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            name="credit-card"
                            class="h-10 w-10"
                        />
                        <span class="text-lg">Formas de pagamento</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Configure as formas de pagamento disponíveis
                </x-slot>
            </x-dashboard-card>
            <x-dashboard-card
                route="conversion-fees.index"
                class="col-span-12 md:col-span-6 lg:col-span-4"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-10 w-10"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"
                            />
                        </svg>
                        <span class="text-lg">Taxas de conversão</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Configure as taxas aplicadas na conversão
                </x-slot>
            </x-dashboard-card>
            <x-dashboard-card
                route="source-currencies.index"
                class="col-span-12 md:col-span-6 lg:col-span-4"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            name="currency-dollar"
                            class="h-10 w-10"
                        />
                        <span class="text-lg">Moedas de origem</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Configure as moedas de origem disponíveis para conversão
                </x-slot>
            </x-dashboard-card>
            <x-dashboard-card
                route="target-currencies.index"
                class="col-span-12 md:col-span-6 lg:col-span-4"
            >
                <x-slot name="header">
                    <div class="flex items-center gap-3">
                        <x-icon
                            name="currency-euro"
                            class="h-10 w-10"
                        />
                        <span class="text-lg">Moedas de destino</span>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    Configure as moedas de destino disponíveis para conversão
                </x-slot>
            </x-dashboard-card>
        @endif

    </div>
</x-app-layout>
