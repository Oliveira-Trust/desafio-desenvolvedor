<template>
    <app-layout title="History">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Histórico
            </h2>
        </template>
        <table class="items-center bg-white w-full border-collapse">
            <thead style="">
                <th
                    class="px-6 border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 text-left"
                    v-for="(header, index) in headers" :key="index">
                    {{header.name}}
                </th>
            </thead>
            <tbody style="">
                <tr v-for="(response, index) in conversionResponses" :key="index">
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.currency_origin}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.currency_destiny}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.value}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{checkTypePaymentMethod(response.payment_method)}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.currency_value}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.purchased_value}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.pay_rate}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.conversion_rate}}
                    </td>
                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        {{response.value_without_fees}}
                    </td>
                </tr>
            </tbody>
        </table>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'

export default defineComponent({
    components: {
        AppLayout,
        JetLabel,
        JetInput,
        JetButton,
        JetFormSection,
        JetInputError,
        JetActionMessage,
    },

    props: {
        conversionResponses: {
            type: [Object, String]
        }
    },

    data() {
        return {
            headers: [
                {
                    name: 'Moeda origem',
                },
                {
                    name: 'Moeda destino'
                },
                {
                    name: 'Valor para conversão'
                },
                {
                    name: 'Forma de pagamento'
                },
                {
                    name: 'Cotação'
                },
                {
                    name: 'Valor comprado (moeda destino)'
                },
                {
                    name: 'Taxa pagamento'
                },
                {
                    name: 'Taxa conversão'
                },
                {
                    name: 'Valor utilizado para cotação sem taxas'
                }
            ],
        }
    },

    methods: {
        checkTypePaymentMethod(payment) {
            if(payment == 'ticket') {
                return 'Boleto'
            } else {
                return 'Cartão de crédito'
            }
        }
    }
})

</script>

<style lang="scss" scoped>
.automation-period-options-field {

    input,
    select {
        height: 43px;
        width: 100%;
        display: block;
        padding: 0 1rem;
        border: 1px solid rgb(202, 202, 202);
        border-radius: 4px;
        transition: all .2s;

        &:hover {
            border-color: rgb(197, 194, 194);
        }
    }
}
</style>
