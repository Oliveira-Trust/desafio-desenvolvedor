<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cotação') }}
        </h2>
    </x-slot>
    <div id="spinner" style="display: none;"
        class="animate-spin text-center inline-block size-6 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"
        role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
    </div>
    <div class="py-12" id="app">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Card -->
                <div
                    class="p-4 md:p-5 min-h-[410px]
                            flex flex-col bg-white
                            border shadow-sm rounded-xl
                            dark:bg-neutral-800 dark:border-neutral-700">

                    <div class="text-center mb-8">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                            Conversão
                        </h2>
                    </div>
                    <form id="conversion_form">
                        @csrf
                        <!-- Section -->
                        <div
                            class="grid sm:grid-cols-12
                                    gap-2 sm:gap-4 py-8 first:pt-0
                                    last:pb-0 border-t first:border-transparent
                                    border-gray-200 dark:border-neutral-700
                                    dark:first:border-transparent">

                            <div class="sm:col-span-3">
                                <div class="inline-block">
                                    <label for="af-submit-application-current-company"
                                        class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                        Conversão
                                    </label>
                                </div>
                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-9">
                                <select name="currency" id="currency" required
                                    class="py-2 px-3 pe-9 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected disabled value="">Selecione a moeda</option>
                                    @foreach ($currencies as $abr => $currency)
                                        <option value="{{ $abr }}" @selected(old('currency', $quote->currency) == $currency)>
                                            {{ $currency }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-3">
                                <label for="af-submit-application-desired-salary"
                                    class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    Valor para conversão
                                </label>
                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-9">
                                <input id="af-submit-application-desired-salary" type="number" name="amount" required
                                    value="{{ old('amount', $quote->amount) }}" min="1000" max="100000"
                                    class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">

                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-3">
                                <label for="af-account-gender-checkbox"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Forma de pagamento
                                </label>
                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-9">
                                <div class="sm:flex">
                                    @foreach ($fees as $fee)
                                        <label for="payment-method-{{ $fee['type'] }}"
                                            class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <input type="radio" name="paymentMethod" value="{{ $fee['type'] }}"
                                                required data-fee="{{ $fee['value'] }}"
                                                class="shrink-0 mt-0.5 border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                id="payment-method-{{ $fee['type'] }}">
                                            <span
                                                class="text-sm text-gray-500 ms-3 dark:text-neutral-400">{{ $fee['label'] }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Section -->
                    </form>
                    <div class="mt-5 flex justify-end gap-x-2">
                        <button type="button" onclick="clearForm()"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                            Reiniciar
                        </button>
                        <button type="submit" form="conversion_form"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Calcular
                        </button>
                    </div>
                </div>
                <!-- End Card -->

                <!-- Card -->
                <div
                    class="p-4 md:p-5 min-h-[410px] flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
                    <div class="flex justify-center items-center">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                                Cotação
                            </h2>
                        </div>
                    </div>
                    <!-- End Header -->
                    <!-- Body -->
                    <div class=" overflow-y-auto">
                        <div class="">
                            <ul class="mt-3 flex flex-col">
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Valor para conversão R$</span>
                                        <span id="conversionAmount"> 0</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span id="currencyName">Valor da moeda R$</span>
                                        <span id="bid"> 0</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Taxa de pagamento R$</span>
                                        <span id="paymentRate">0</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Taxa de conversão R$</span>
                                        <span id="conversionRate"> 0</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Valor utilizado para conversão R$</span>
                                        <span id="conversionValue"> 0</span>
                                    </div>
                                </li>
                                <li
                                    class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span id="currencyNameAmount">Valor comprado R$</span>
                                        <span id="convertedAmount">0</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Button -->
                        <div class="mt-5 flex justify-end gap-x-2">
                            <div class="mt-5 flex justify-end gap-x-2">
                                <button type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                                    Cancel
                                </button>
                                <button type="submit" id="buyButton" disabled form="quote_form"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    Comprar
                                </button>

                                <form id="quote_form" action="{{ route('quotes.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="conversion_amount">
                                    <input type="hidden" name="name">
                                    <input type="hidden" name="currency_origin">
                                    <input type="hidden" name="currency_name">
                                    <input type="hidden" name="payment_method">
                                    <input type="hidden" name="fee">
                                    <input type="hidden" name="currency_value">
                                    <input type="hidden" name="conversion_fee">
                                    <input type="hidden" name="payment_rate">
                                    <input type="hidden" name="conversion_rate">
                                    <input type="hidden" name="conversion_value">
                                    <input type="hidden" name="converted_amount">
                                </form>
                            </div>
                        </div>
                        <!-- End Buttons -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
    <script>
        function mascara(valor) {
            var valorAlterado = valor.value;
            valorAlterado = valorAlterado.replace(/\D/g, ""); // Remove todos os não dígitos
            valorAlterado = valorAlterado.replace(/(\d+)(\d{2})$/, "$1,$2"); // Adiciona a parte de centavos
            valorAlterado = valorAlterado.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Adiciona pontos a cada três dígitos
            valorAlterado = "R$ " + valorAlterado;
            valor.value = valorAlterado;
        }
    </script>
    <script>
        function clearForm() {
            const conversionAmount = document.getElementById('conversionAmount');
            const currencyName = document.getElementById('currencyName');
            const bid = document.getElementById('bid');
            const paymentRate = document.getElementById('paymentRate');
            const conversionRate = document.getElementById('conversionRate');
            const conversionValue = document.getElementById('conversionValue');
            const currencyNameAmount = document.getElementById('currencyNameAmount');
            const convertedAmount = document.getElementById('convertedAmount');
            conversionAmount.innerText = 0;
            currencyName.innerText = `Valor da moeda R$`;
            bid.innerText = 0;
            paymentRate.innerText = 0;
            conversionRate.innerText = 0;
            conversionValue.innerText = 0;
            currencyNameAmount.innerText = `Valor comprado R$`;
            convertedAmount.innerText = 0;
            var buyButton = document.getElementById('buyButton');
            // Desabilita o botão de envio
            buyButton.disabled = true;
            document.getElementById('conversion_form').reset();
            document.querySelectorAll('#quote_form input[type="hidden"]').forEach(input => {
                if (input.name !== '_token') {
                    input.value = '';
                }
            });
        }
        document.getElementById('conversion_form').addEventListener('submit', function(event) {
            event.preventDefault();
            var currency = document.querySelector('select[name="currency"]').value;
            var amount = document.querySelector('input[name="amount"]').value;
            var csrfToken = document.querySelector('input[name="_token"]').value;
            var paymentMethodElement = document.querySelector('input[name="paymentMethod"]:checked');
            var paymentMethod = paymentMethodElement ? paymentMethodElement.value : null;
            var fee = paymentMethodElement ? paymentMethodElement.dataset.fee : null;

            const data = {
                currency,
                amount,
                payment_method: paymentMethod,
                fee,
                _token: csrfToken
            };
            document.getElementById('spinner').style.display = 'block';
            axios.post('/quotes/calc', data)
                .then(function(response) {
                    quoteCalcResult(response.data);
                    var buyButton = document.getElementById('buyButton');
                    // Desabilita o botão de envio
                    buyButton.disabled = false;
                })
                .catch(function(error) {
                    console.log(error);
                }).finally(function() {
                    document.getElementById('spinner').style.display = 'none';
                });
        });

        function quoteCalcResult(quote) {
            const conversionAmount = document.getElementById('conversionAmount');
            const currencyName = document.getElementById('currencyName');
            const bid = document.getElementById('bid');
            const paymentRate = document.getElementById('paymentRate');
            const conversionRate = document.getElementById('conversionRate');
            const conversionValue = document.getElementById('conversionValue');
            const currencyNameAmount = document.getElementById('currencyNameAmount');
            const convertedAmount = document.getElementById('convertedAmount');

            conversionAmount.innerText = quote.conversion_amount;
            currencyName.innerText = `Valor de 1 ${quote.currency_name}`;
            bid.innerText = quote.currency_value;
            paymentRate.innerText = quote.payment_rate;
            conversionRate.innerText = quote.conversion_rate;
            conversionValue.innerText = quote.conversion_value;
            currencyNameAmount.innerText = `Valor comprado em ${quote.currency_name}`;
            convertedAmount.innerText = quote.converted_amount;

            Object.keys(quote).forEach(key => {
                const input = document.querySelector(`input[name="${key}"]`);
                if (input) {
                    input.value = quote[key];
                }
            });
        }
    </script>
</x-app-layout>
