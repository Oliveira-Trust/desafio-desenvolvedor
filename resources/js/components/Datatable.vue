<script setup>
import { computed } from "vue";

const props = defineProps({
    data: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="w-full relative overflow-x-auto shadow-md rounded">
        <table class="w-full text-sm text-left rtl:text-right text-trust-p1">
            <thead
                class="text-xs text-trust-p1 uppercase bg-trust-p7 dark:text-gray-300"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Origin</th>
                    <th scope="col" class="px-6 py-3">Destiny</th>
                    <th scope="col" class="px-6 py-3">Conversion Amount</th>
                    <th scope="col" class="px-6 py-3">Amount Destination</th>
                    <th scope="col" class="px-6 py-3">Currency purchased</th>
                    <th scope="col" class="px-6 py-3">Used Conversion</th>
                    <th scope="col" class="px-6 py-3">Payment Rate</th>
                    <th scope="col" class="px-6 py-3">Conversion Rate</th>
                    <th scope="col" class="px-6 py-3">Payment</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="odd:bg-white odd:dark:bg-trust-p3 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
                    v-for="(value, key) of props.data.histories"
                    :key="key"
                >
                    <td
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ props.data.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.origin_currency }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.destiny_currency }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.conversion_amount }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.amount_destination_currency }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.amount_currency_purchased }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.amount_used_conversion }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.payment_rate }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.conversion_rate }}
                    </td>
                    <td class="px-6 py-4">
                        {{ value.payments.name }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
