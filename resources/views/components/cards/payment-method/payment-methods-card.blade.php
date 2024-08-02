<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">
    <div class="flex items-center justify-between">
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Formas de Pagamento</h5>
        <button
            class="flex h-6 w-6 items-center justify-center rounded-full bg-blue-700 text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            title="Adicionar nova forma de pagamento" x-data
            x-on:click="$dispatch('open-modal', 'create-payment-method')">
            <svg class="h-5 w-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
        </button>
    </div>
    <x-tables.payment-methods-table />
    <x-modal name="create-payment-method" :show="$errors->paymentMethod->isNotEmpty()" focusable>
        <x-cards.payment-method.create-form-card />
    </x-modal>
</div>
