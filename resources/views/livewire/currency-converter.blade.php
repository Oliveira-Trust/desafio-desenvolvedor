<div class="flex items-center pt-4 flex-col container mx-auto">
    @if(!empty($callback_errors))
        <div>
            @foreach($callback_errors as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="w-full flex gap-3.5 flex-col md:flex-row">
        <div class="flex-1 flex flex-col gap-y-5">
            <div class="bg-white rounded-2xl p-4 shadow-sm">
                <form class="mt-2" wire:submit="convert">
                    <h1 class="text-2xl font-bold flex-1">Faça sua conversão agora mesmo</h1>

                    <div class="my-3 gap-y-2 flex flex-col">
                        <p class="text-zinc-400">
                            Valores abaixo de 3000, a taxa será de {{$taxConversion[0]}} e, acima, {{$taxConversion[1]}}
                            .
                        </p>
                        <p class="text-zinc-400">
                            Para pagamentos em cartão, a taxa será de {{$paymentMethodTax[1]}} e, caso seja
                            boleto, {{$paymentMethodTax[0]}}.
                        </p>
                    </div>

                    <div class="my-8">
                        <div class="gap-x-2 grid grid-cols-2 gap-y-4">
                            <div class="col-span-full">
                                <label for="amount" class="@error('amount') text-red-400 @enderror">Valor
                                    para Conversão (BRL)</label>
                                <input
                                    placeholder="1000,00"
                                    id="amount"
                                    wire:model="amount"
                                    min="1000"
                                    max="100000"
                                    x-mask:dynamic="$money($input, ',', '.', 2)"
                                    class="@error('amount') border-red-400 @enderror col-span-4 block w-full p-2.5 text-gray-900 border rounded-lg bg-gray-50 text-base focus:ring-base-red focus:border-base-red mt-2">
                            </div>

                            <div class="">
                                <label for="destinationCurrency"
                                       class="@error('destinationCurrency') text-red-400 @enderror">Moeda de
                                    Destino</label>
                                <select id="destinationCurrency" wire:model.blur="destinationCurrency"
                                        class="@error('destinationCurrency') border-red-400 @enderror col-span-2 bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-base-red focus:border-base-red block w-full p-2.5 mt-2">
                                    <option selected>Selecione a moeda</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>

                            <div class="">
                                <label for="paymentMethod" class="@error('paymentMethod') text-red-400 @enderror">Forma
                                    de Pagamento</label>
                                <select id="paymentMethod" wire:model.blur="paymentMethod"
                                        class="@error('paymentMethod') border-red-400 @enderror col-span-2 bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-base-red focus:border-base-red block w-full p-2.5 mt-2">
                                    <option selected>Forma de Pagamento</option>
                                    <option value="boleto">Boleto</option>
                                    <option value="cartao">Cartão de Crédito</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-x-2">
                        <button
                            type="button"
                            wire:click="$dispatch('openModal', { component: 'components.config-tax'
                            , arguments: { paymentMethodTax1: {{$this->paymentMethodTax[0]}}, paymentMethodTax2: {{$this->paymentMethodTax[1]}}, taxConversion1: {{$this->taxConversion[0]}}, taxConversion2: {{$this->taxConversion[1]}} }})"
                            class="border-button">
                            Configurações
                        </button>
                        <button type="submit" class="base-button">Converter</button>
                    </div>
                </form>
            </div>

            @if(!empty($result))
                <div class="bg-white max-w-screen w-full rounded-2xl p-6">
                    <div class="flex flex-row justify-between">
                        <h3 class="text-2xl font-bold mb-3 flex-1">Resultado da Conversão</h3>
                        <div class="">
                            <button type="button" wire:click="sendMail" class="base-button">Enviar por email</button>
                        </div>
                    </div>
                    <div class="flex flex-col w-full gap-y-1.5">
                        <p>Moeda de Origem: {{ $result['source_currency'] }}</p>
                        <p>Moeda de Destino: {{ $result['destination_currency'] }}</p>
                        <p>Valor para Conversão: R$ {{ number_format($result['amount'], 2, ',', '.') }}</p>
                        <p>Forma de Pagamento: {{ ucfirst($result['payment_method']) }}</p>
                        <p>1 BRL
                            = {{ $result['destination_currency'] }} {{ number_format($result['rate'], 2, ',', '.') }}</p>
                        <p>1 USD
                            = {{ $result['source_currency'] }} {{ number_format((1 / $result['rate']), 2, ',', '.') }}</p>
                        <p>Valor
                            Convertido: {{ $result['destination_currency'] }} {{ number_format($result['converted_amount'], 2, ',', '.') }}</p>
                        <p>Taxa de Pagamento: R$ {{ number_format($result['tax_payment'], 2, ',', '.') }}</p>
                        <p>Taxa de Conversão: R$ {{ number_format($result['tax_conversion'], 2, ',', '.') }}</p>
                        <p>Taxa de Câmbio Utilizada: {{ $result['rate'] }}</p>
                        <p>Valor Utilizado para Conversão (descontando as taxas):
                            R$ {{ number_format($result['amount_after_taxes'], 2, ',', '.') }}</p>
                    </div>
                </div>
            @endif
        </div>

        @auth
            <livewire:currency-historic/>
        @endauth
    </div>
</div>
