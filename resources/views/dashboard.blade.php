<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cotações') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid max-w-7xl mx-auto sm:px-6 lg:px-8 gap-x-5">

            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Realizar Cotação</h3>
                </div>
                <form method="POST" x-data="setup()" @submit.prevent="submit()" >
                    <div class="rounded-md bg-red-50 p-4 mb-5" x-show="formErrors.length">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Ocorreu <span x-html="formErrors.length"></span> erro(s) ao realizar a cotação
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul role="list" class="list-disc pl-5 space-y-1">
                                        <template x-for="(formError, index) in formErrors" :key="index">
                                            <li x-text="formError.message"></li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-10 gap-4">
                        <div class="col-span-7 sm:col-span-3">
                            <x-jet-label>Valor</x-jet-label>
                            <input type="text" name="amount" x-model="form.amount" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                        </div>
                        <div class="col-span-7 sm:col-span-3">
                            <x-jet-label>Moeda de destino</x-jet-label>
                            <select name="destination_currency" x-model="form.destination_currency" x-init="getCurrencies()" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <template x-for="(currency, index) in currencies" :key="index">
                                        <option x-text="currency" />
                                    </template>
                            </select>
                        </div>
                        <div class="col-span-7 sm:col-span-3">
                            <x-jet-label>Forma de Pagamento</x-jet-label>
                            <select name="payment_method" x-model="form.payment_method" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="billet">Boleto</option>
                                <option value="credit-card">Cartão de Crédito</option>
                            </select>
                        </div>
                        <div class="col-span-6">
                            <button type="submit" :disabled="form.busy" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                <svg x-show="form.busy" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <template x-if="!form.busy">
                                    <span>{{ __('Enviar') }}</span>
                                </template>
                                <template x-if="form.busy">
                                    <span>{{ __('Processando') }}</span>
                                </template>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                <div class="py-6 px-4 space-y-6 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Histórico de Cotações</h3>
                </div>
                 <table class="min-w-full divide-y divide-gray-200" x-data="{ quotes: [], loading: false }" x-init="
                         async function getQuotes() {
                            const { data } = await axios.get('/api/quotes')
                            this.quotes = data.data;
                        }">
                     <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Origem</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destino</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor original</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Forma de pagamento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor convertido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taxa de pagamento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taxa de conversão</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valor conversão</th>
                        </tr>
                     </thead>
                     <tbody>
                     <template x-for="quote in quotes" :key="quote.id">
                         <tr>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.origin_currency"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.destination_currency"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.amount"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.payment_method"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.amount_received"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.payment_method_fee"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.conversion_fee"></td>
                             <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-html="quote.amount_converted"></td>
                         </tr>
                     </template>
                     </tbody>
                 </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>



    function setup() {
        return {

            currencies: [],
            formErrors: [],

            form: {
                origin_currency: 'BRL',
                destination_currency: 'USD',
                amount: 1000,
                payment_method: 'billet',
                busy: false,
            },

            async getCurrencies() {
                const { data } = await axios.get('/api/currencies');
                this.currencies = data;
            },

            async submit() {
                try {
                    this.form.busy = true;
                    await axios.post('/api/quotes', this.form)
                    this.form.busy = false;
                    this.formErrors = [];
                } catch (error) {
                    const { status } = error.response;
                    if (status === 422) {
                        Object.keys(error.response.data.errors).forEach(key => {
                            this.formErrors.push({
                                message: error.response.data.errors[key][0]
                            });
                        });
                    }
                    this.form.busy = false;
                }
            },

        }
    }

</script>
