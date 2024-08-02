@props([
    'action' => '',
])

<div
    class="w-full rounded-lg border border-gray-200 bg-white p-2 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-4 md:p-6">

    <form class="space-y-6" method="POST" action="{{ $action }}">
        @method('POST')
        @csrf
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Faça aqui sua conversão</h5>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <x-forms.select label="Moeda de origem" default="BRL" name="origin" disabled="true" />
            <x-forms.select label="Moeda de destino" name="destination" :options="App\Enums\Currencies::toArray()" />
            <x-forms.money type="text" label="Valor a ser convertido" name="amount" />
            <x-forms.select label="Forma de Pagamento" name="payment_method" :options="paymentMethods()" />
        </div>

        <div class="flex justify-end">
            <x-buttons.primary type="submit" label="Converter" />
        </div>
    </form>
</div>
