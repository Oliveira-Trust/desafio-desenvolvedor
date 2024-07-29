<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cotação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (isset($error))
                <div class="bg-red-500 text-white p-4 rounded mt-6">
                    {{ $error }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">{{ __('Cotação') }}</h3>
                    <div class="overflow-x-auto">
                        <form method="post" action="" class="mt-6 space-y-6">
                            @csrf
                            @method('post')
                    
                            <div class="flex space-x-3">
                                <div class="flex-1 mx-6">
                                    <x-input-label for="moedaOrigem" :value="__('Moeda Origem')" />
                                    <x-text-input id="moedaOrigem" name="moedaOrigem" type="text" class="mt-1 block w-full" value="{{ $exchangeDetails['coinName'] ?? old('moedaOrigem') }}" required autofocus autocomplete="moedaOrigem" readonly />
                                    <x-input-error class="mt-2 " :messages="$errors->get('moedaOrigem')" />
                                </div>
                                <div class="flex-1 mx-6">
                                    <x-input-label for="quantidadeMoedaOrigem" :value="__('Quantidade')" />
                                    <x-text-input id="quantidadeMoedaOrigem" name="quantidadeMoedaOrigem" type="number" class="mt-1 block w-full" :value="1 ?? old('quantidadeMoedaOrigem')" required autofocus autocomplete="quantidadeMoedaOrigem" oninput="validateQuantity(), updateQuantity();" />
                                    <x-input-error class="mt-2" :messages="$errors->get('quantidadeMoedaOrigem')" />
                                    <p id="error-message" class="text-red-500 text-sm mt-2" style="display: none;"></p>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <div class="flex-1 mx-6">
                                    <x-input-label for="moedaDestino" :value="__('Moeda Destino')" />
                                    <x-text-input id="moedaDestino" name="moedaDestino" type="text" class="mt-1 block w-full" value="{{ $exchangeDetails['coinInName'] ?? old('moedaOrigem') }}" required autofocus autocomplete="moedaDestino" readonly/>
                                    <x-input-error class="mt-2 " :messages="$errors->get('moedaDestino')" />
                                </div>
                                <div class="flex-1 mx-6">
                                    <x-input-label for="quantidadeMoedaDestino" :value="__('Quantidade')" />
                                    <x-text-input id="quantidadeMoedaDestino" name="quantidadeMoedaDestino" type="text" class="mt-1 block w-full" value="{{ $exchangeDetails['bid'] ?? old('quantidadeMoedaDestino') }}" required autofocus autocomplete="quantidadeMoedaDestino" readonly />
                                    <x-input-error class="mt-2" :messages="$errors->get('quantidadeMoedaDestino')" />
                                </div>
                            </div>
                    
                            <div class="flex space-x-3">
                                <div class="flex-1 mx-6">
                                    <x-input-label for="pagamento" :value="__('Forma de Pagamento')" />
                                    <select id="pagamento" name="pagamento" class="mt-1 block w-full" onchange="updateValorTotal()" required>
                                        <option value="boleto">Boleto (1,45%)</option>
                                        <option value="cartao">Cartão de Crédito (7,63%)</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('pagamento')" />
                                </div>
                                <div class="flex-1 mx-6">
                                    <x-input-label for="valorTaxaPagamento" :value="__('Taxa de pagamento em Reais')" />
                                    <x-text-input id="valorTaxaPagamento" name="valorTaxaPagamento" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="valorTaxaPagamento" readonly />
                                    <x-input-error class="mt-2 " :messages="$errors->get('valorTaxaPagamento')" />
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <div class="flex-1 mx-6">
                                    <x-input-label for="valorTaxaConversao" :value="__('Taxa de Conversão')" />
                                    <x-text-input id="valorTaxaConversao" name="valorTaxaConversao" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="valorTaxaConversao" readonly />
                                    <x-input-error class="mt-2 " :messages="$errors->get('valorTaxaConversao')" />
                                </div>
                                <div class="flex-1 mx-6">
                                    <x-input-label for="valorTotal" :value="__('Valor Total')" />
                                    <x-text-input id="valorTotal" name="valorTotal" type="text" class="mt-1 block w-full" value="" required autofocus autocomplete="valorTotal" readonly/>
                                    <x-input-error class="mt-2 " :messages="$errors->get('valorTotal')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button id="submit-button" disabled>{{ __('Simular') }}</x-primary-button>
                    
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateQuantity() {
            const quantidadeMoedaOrigem = document.getElementById('quantidadeMoedaOrigem').value;
            const submitButton = document.getElementById('submit-button');
            const errorMessage = document.getElementById('error-message');

            if (quantidadeMoedaOrigem < 1000) {
                submitButton.disabled = true;
                errorMessage.textContent = 'A quantidade de moeda de origem não pode ser menor do que 1000.';
                errorMessage.style.display = 'block';
            } else if (quantidadeMoedaOrigem > 100000) {
                submitButton.disabled = true;
                errorMessage.textContent = 'A quantidade de moeda de origem não pode ser maior do que 100000.';
                errorMessage.style.display = 'block';
            } else {
                submitButton.disabled = false;
                errorMessage.style.display = 'none';
            }
        }

        function updateQuantity() {
            const quantidadeMoedaOrigem = document.getElementById('quantidadeMoedaOrigem').value;
            const quantidadeMoedaDestino = document.getElementById('quantidadeMoedaDestino');
            const exchangeRate = {{ $exchangeDetails['bid'] ?? 1 }};
            quantidadeMoedaDestino.value = (quantidadeMoedaOrigem * exchangeRate).toFixed(2);
            updateValorTotal();
        }

        function updateValorTotal() {
            const quantidadeMoedaOrigem = parseFloat(document.getElementById('quantidadeMoedaOrigem').value);
            const pagamento = document.getElementById('pagamento').value;
            const valorTotal = document.getElementById('valorTotal');
            const valorTaxaPagamento = document.getElementById('valorTaxaPagamento');
            const valorTaxaConversao = document.getElementById('valorTaxaConversao');
            let total = quantidadeMoedaOrigem;
            let taxaConversao = 0;
            let taxaPagamento = 0;

            // Aplicar taxa de conversão
            if (quantidadeMoedaOrigem < 3000) {
                taxaConversao = quantidadeMoedaOrigem * 0.02;
            } else {
                taxaConversao = quantidadeMoedaOrigem * 0.01;
            }
            total += taxaConversao;

            // Calcular taxa de forma de pagamento
            if (pagamento === 'cartao') {
                taxaPagamento = quantidadeMoedaOrigem * 0.0763;
            } else if (pagamento === 'boleto') {
                taxaPagamento = quantidadeMoedaOrigem * 0.0145;
            }

            total += taxaPagamento;

            valorTaxaConversao.value = taxaConversao.toFixed(2);
            valorTaxaPagamento.value = taxaPagamento.toFixed(2);
            valorTotal.value = total.toFixed(2);
        }
    </script>
</x-app-layout>
