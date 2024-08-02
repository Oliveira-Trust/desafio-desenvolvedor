<template>
    <div
        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <p class="text-lg font-bold">
            Real para
            {{ currencyConversion.destination_currency_name }}
        </p>
        <p class="mb-12 text-sm">
            Método de Pagamento:
            {{ currencyConversion.payment_method.name }}
        </p>
        <ol
            class="relative border-dashed border-s border-gray-400 dark:border-gray-700"
        >
            <li class="mb-12 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-500 dark:text-gray-500"
                    >Valor de 1 R$ convertido em
                    {{ currencyConversion.destination_currency }}
                    <span
                        >R$
                        {{ currencyConversion.value_currency_conversion }}</span
                    ></time
                >
            </li>
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-500 dark:text-gray-500"
                    >Valor usado para conversão
                    <span
                        >R$ {{ currencyConversion.value_conversion }}</span
                    ></time
                >
            </li>

            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-500 dark:text-gray-500"
                    >Taxa de Pagamento de
                    {{ currencyConversion.payment_method.fee_percentage }}
                    <span>
                        <span class="text-red-500">-</span>
                        R$
                        {{ currencyConversion.payment_rate }}</span
                    ></time
                >
                <p
                    class="mb-4 w-1/2 text-sm font-normal text-gray-500 dark:text-gray-400"
                >
                    Taxa aplicada pelo método de pagamento
                    {{ currencyConversion.payment_method.name }}
                </p>
            </li>
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-500 dark:text-gray-500"
                    >Taxa de Conversão de
                    {{ currencyConversion.applied_conversion_rate }}%
                    <span>
                        <span class="text-red-500 font-bold">-</span>
                        R$
                        {{ currencyConversion.conversion_rate }}</span
                    ></time
                >
                
            </li>
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-800 dark:text-gray-500"
                    >Valor final
                    <span>
                        R$
                        {{
                            currencyConversion.amount_conversions_subtracting_fees
                        }}</span
                    ></time
                >
                <p
                    class="mb-4 w-1/2 text-sm font-normal text-gray-500 dark:text-gray-400"
                >
                    Taxas aplicadas no valor de compra diminuindo no valor total
                    de conversão.
                </p>
            </li>
            <li class="mb-10 ms-4">
                <div
                    class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                ></div>
                <time
                    class="mb-1 flex justify-between font-bold leading-none text-gray-800 dark:text-gray-500"
                    >Valor comprado em
                    {{ currencyConversion.destination_currency }}
                    <span class="text-green-500">
                        {{ currencyConversion.destination_currency }}
                        {{ currencyConversion.purchased_value_currency }}</span
                    ></time
                >
            </li>
        </ol>
        <p class="text-sm text-right mt-12 text-gray-500 dark:text-gray-700">Feito em {{ currencyConversion.created_at }}</p>
    </div>
</template>

<script setup>
defineProps({
    errors: Object,
    currencyConversion: Object,
});

const convertToNumber = (value) => {
    // Remove pontos que são separadores de milhar
    let cleanedValue = value.replace(/\./g, "");
    // Substitui a vírgula por um ponto
    cleanedValue = cleanedValue.replace(",", ".");
    // Converte a string resultante para um número
    return parseFloat(cleanedValue);
};
</script>
