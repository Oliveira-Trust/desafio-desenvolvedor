<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configuração de Taxas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="grid max-w-7xl mx-auto sm:px-6 lg:px-8 gap-x-5">

            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Taxas de conversão</h3>
                </div>
                <div x-data="exchange()" x-init="getExchangeFees()">
                    <div class="grid grid-cols-2 gap-6 gap-x-3">
                    <form @submit.prevent="submit()" class="w-full flex flex-col">
                        <template x-for="(exchange, index) in exchangeFees" :key="exchange.id">
                             <div class="flex flex-row w-full">
                                 <div class="col-span-7 sm:col-span-3 mt-4 mr-4">
                                     <x-jet-label>Valor minimo:</x-jet-label>
                                     <input type="text" x-bind:name="exchangeFees[index]" x-model="exchangeFees[index].min_amount" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" x-if="index == 'fees'"/>
                                 </div>
                                 <div class="col-span-7 sm:col-span-3 mt-4 mr-4">
                                     <x-jet-label>Valor maximo:</x-jet-label>
                                     <input type="text" x-bind:name="exchangeFees[index]" x-model="exchangeFees[index].max_amount" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" x-if="index == 'fees'"/>
                                 </div>
                                 <div class="col-span-7 sm:col-span-3 mt-4 mr-4">
                                     <x-jet-label>Taxa:</x-jet-label>
                                     <input type="number" step="0.01" x-bind:name="exchangeFees[index]" x-model="exchangeFees[index].fees"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" x-if="index == 'fees'"/>
                                 </div>
                             </div>
                        </template>
                        <div class="mt-4">
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
                    </form>
                    </div>
                </div>
            </div>
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 mt-4">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Formas de Pagamento</h3>
                </div>

                <form method="POST" x-data="setup()" @submit.prevent="submit()" x-init="getPaymentMethods()">
                    <div class="grid grid-cols-10 gap-4">
                        <template x-for="(method, index) in paymentMethods" :key="index">
                            <div class="col-span-7 sm:col-span-3">
                                <x-jet-label x-html="method.name"></x-jet-label>
                                <input type="number" step="0.01" name="fees" x-model="paymentMethods[index].fees" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </template>
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
        </div>
    </div>
</x-app-layout>

<script>

    function exchange() {
        return {
            exchangeFees: [],

            form: {
                busy: false,
            },


            async getExchangeFees() {
                const { data } = await axios.get('/api/exchange-fees')
                this.exchangeFees = data;
            },

            async submit() {
                this.form.busy = true;
                const { data } = await axios.put('/api/exchange-fees', this.exchangeFees)
                this.form.busy = false;
            }
        }
    }

    function setup() {
        return {
            paymentMethods: [],

            form: {
                busy: false,
            },

            async getPaymentMethods() {
                const { data } = await axios.get('/api/payment-methods-fee');
                this.paymentMethods = data;
            },

            async submit() {
                try {
                    this.form.busy = true;
                    const { data } = await axios.put('/api/payment-methods-fee', this.paymentMethods)
                    this.form.busy = false;
                } catch (error) {
                    this.form.busy = false;
                }
            },
        }
    }
</script>
