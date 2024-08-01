<div class="py-12 max-w-7xl mx-auto">
    <div class="flex">
        <div class="mx-auto sm:px-6 lg:px-8 w-full">
            <div class="mx-auto w-full">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Taxas por Modalidade de Pagamento:') }}
                        </h2>
                        <p class="dark:text-slate-400 text-sm">{{ __('Informe o valor da taxa em percentual (%).')}}</p>

                        <form wire:submit.prevent="salvarTaxaPgto">
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
                                            class="text-slate-700 rounded w-full border border-gray-400 px-2 py-1 {{$pgtoIsDisabled ? 'bg-slate-400' : 'bg-white'}}"
                                            {{ $pgtoIsDisabled ? 'disabled' : '' }}
                                            required
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
                                            class="text-slate-700 rounded w-full border border-gray-400 px-2 py-1 {{$pgtoIsDisabled ? 'bg-slate-400' : 'bg-white'}}"
                                            {{ $pgtoIsDisabled ? 'disabled' : '' }}
                                            required
                                        />
                                    </div>
                                </div>
        
                                <div class="flex gap-3 mt-5 justify-end">
                                    <x-primary-button wire:click.prevent='habilitaEdicaoPgto'>{{ __('Editar') }}</x-primary-button>
                                    <x-secondary-button type="submit">{{ __('Salvar') }}</x-secondary-button>
                                </div>

                                @if ($messages['sucesso_pgto'])
                                    <p class="bg-emerald-400 text-emerald-950 text-center text-sm rounded-lg mt-4 px-3 py-2">{{ $messages['sucesso_pgto'] }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto sm:px-6 lg:px-8 w-full">
            <div class="mx-auto w-full">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Taxas por Valor da Compra:') }}
                        </h2>
                        <p class="dark:text-slate-400 text-sm">{{ __('Informe o valor da taxa em percentual (%).')}}</p>

                        <form wire:submit.prevent="salvarTaxaValor">
                            <div class="mt-6">
                                <div class="flex mb-4">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="flex w-80 justify-end">
                                            <x-input-label for="valor" :value="__('Valor de Base')" />
                                        </div>
                                        <input
                                            type="text"
                                            name="valor"
                                            id="valor"
                                            wire:model="valorBase"
                                            x-mask:dynamic="$money($input, ',')"
                                            class="text-slate-700 rounded w-full border border-gray-400 px-2 py-1 {{$valorIsDisabled ? 'bg-slate-400' : 'bg-white'}}"
                                            {{ $valorIsDisabled ? 'disabled' : '' }}
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="flex mb-4">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="flex w-80 justify-end">
                                            <x-input-label for="taxa_valor_menor" :value="__('Taxa para valor Menor')" />
                                        </div>
                                        <input
                                            type="text"
                                            name="taxa_valor_menor"
                                            id="taxa_valor_menor"
                                            wire:model="taxaMenorValor"
                                            x-mask="9,999"
                                            class="text-slate-700 rounded w-full border border-gray-400 px-2 py-1 {{$valorIsDisabled ? 'bg-slate-400' : 'bg-white'}}"
                                            {{ $valorIsDisabled ? 'disabled' : '' }}
                                            required
                                        />
                                    </div>
                                </div>
        
                                <div class="flex">
                                    <div class="flex gap-3 items-center w-full">
                                        <div class="flex w-80 justify-end">
                                            <x-input-label for="taxa_valor_maior" :value="__('Taxa para valor Maior')" />
                                        </div>
                                        <input
                                            type="text"
                                            name="taxa_valor_maior"
                                            id="taxa_valor_maior"
                                            wire:model="taxaMaiorValor"
                                            x-mask="9,999"
                                            class="text-slate-700 rounded w-full border border-gray-400 px-2 py-1 {{$valorIsDisabled ? 'bg-slate-400' : 'bg-white'}}"
                                            {{ $valorIsDisabled ? 'disabled' : '' }}
                                            required
                                        />
                                    </div>
                                </div>
        
                                <div class="flex gap-3 mt-5 justify-end">
                                    <x-primary-button wire:click.prevent='habilitaEdicaoValor'>{{ __('Editar') }}</x-primary-button>
                                    <x-secondary-button type="submit">{{ __('Salvar') }}</x-secondary-button>
                                </div>

                                @if ($messages['sucesso_valor'])
                                    <p class="bg-emerald-400 text-emerald-950 text-center text-sm rounded-lg mt-4 px-3 py-2">{{ $messages['sucesso_valor'] }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>