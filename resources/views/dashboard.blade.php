<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compras de moedas estrangeiras') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataCurrenciesPurchases" @searchcurrenciespurchases="searchCurrenciesPurchases()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-init="searchCurrenciesPurchases()">
            <div class="grid md:grid-cols-3 ">
                <div class="p-2">
                    <button @click="openModal = true" class="flex flex-col justify-center items-center bg-white overflow-hidden shadow-sm sm:rounded-lg w-full h-full hover:bg-blue-500 hover:text-white text-blue-500 py-16">
                        <div class="text-3xl uppercase font-bold">
                            Nova compra
                        </div>
                    </button>
                </div>
                <template x-for="purchase in currenciesPurchases">
                    <div class="p-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex flex-col p-6 bg-white border-b border-gray-200">

                                <div class="py-2">
                                    <h2 class="font-bold text-xl" x-text="`${purchase.origin_currency} ${purchase.origin_currency_value} => ${purchase.converted_currency_value} ${purchase.destination_currency.symbol}`"></h2>
                                    <p>1 <span x-text="purchase.destination_currency.symbol"></span> = <span x-text="purchase.destination_currency_price"></span> BRL</p>
                                    <p>Forma de pagamento: <span x-text="purchase.payment_type.name"></span></p>
                                    <p class="text-xs">Taxa de pagamento: R$ <span class="font-bold" x-text="purchase.payment_fee_value"></span> <span x-text="`(${purchase.payment_fee}%)`"></span></p>
                                    <template x-if="purchase.conversion_fees.length">
                                        <div>
                                            <p class="text-xs">Taxa(s) de conversão:</p>
                                            <template x-for="conversion_fees in purchase.conversion_fees">
                                                <p>
                                                    <span class="font-bold text-xs" x-text="`R$ ${conversion_fees.convertion_fee_value}`"></span>
                                                    <span class="text-xs" x-text="`(${conversion_fees.convertion_fee}%) para valor`"></span>
                                                    <span class="text-xs" x-text="conversion_fees.conversion_rule"></span>
                                                </p>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex justify-end">
                                    <p class="text-xs" x-text="purchase.created_at"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <x-buy-currency-form open="openModal"/>
    </div>

</x-app-layout>

