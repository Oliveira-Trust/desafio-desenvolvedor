<div class="py-12 max-w-7xl mx-auto">
    <div class="flex">
        <div class="mx-auto sm:px-6 lg:px-8 w-full">
            <div class="mx-auto w-full">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Taxas por Modalidade de Pagamento:') }}
                        </h2>
                        <p class="dark:text-slate-400 text-sm">{{ __('Informe o valor da taxa em percentual.')}}</p>

                        <form wire:submit.prevent="salvar">
                            <div class="mt-6">
                                <div class="flex mb-4">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="flex w-80 justify-end">
                                            <x-input-label for="tx_boleto" :value="__('Taxa Boleto')" />
                                        </div>
                                        <input
                                            type="text"
                                            name="tx_boleto"
                                            id="tx_boleto"
                                            wire:model="taxaBoleto"
                                            x-mask="9,999"
                                            class="bg-white text-slate-700 rounded w-full border border-gray-400 p-2 disable:bg-slate-400 {{$isDisabled ? 'bg-slate-300' : ''}}"
                                            required
                                            :disabled="$isDisabled"
                                        />
                                    </div>
                                </div>
        
                                <div class="flex">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="flex w-80 justify-end">
                                            <x-input-label for="tx_cartao" :value="__('Taxa Cartão de Crédito')" />
                                        </div>
                                        <input
                                            type="text"
                                            name="tx_cartao"
                                            id="tx_cartao"
                                            wire:model="taxaCartao"
                                            x-mask="9,999"
                                            class="bg-white text-slate-700 rounded w-full border border-gray-400 p-2 {{$isDisabled ? 'bg-slate-300' : ''}}"
                                            required
                                        />
                                    </div>
                                </div>
        
                                <div class="flex gap-3 mt-5 justify-end">
                                    <x-primary-button wire:click.prevent='toggleEdicao'>{{ __('Editar') }}</x-primary-button>
                                    <x-secondary-button type="submit">{{ __('Salvar') }}</x-secondary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>

        <div class="mx-auto sm:px-6 lg:px-8 w-full">
           <h1 class="text-white">...</h1>
        </div>
    </div>
    
</div>