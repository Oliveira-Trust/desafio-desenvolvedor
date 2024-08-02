<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import moment from 'moment';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';

defineProps({
    listHistorycCurrency: {
        type: Array,
        required: true,
    }
});
const formatCurrency = (value, currency) => {
    return value.toLocaleString('en-US', {style: 'currency', currency: currency});
};
</script>

<template>
    <Head title="History"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">History Currency Convert</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="card">
                            <DataTable :value="listHistorycCurrency" tableStyle="min-width: 50rem">
                                <template #header>
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <span class="text-xl font-bold">History Currency Convert</span>
                                        <Button icon="pi pi-refresh" rounded raised/>
                                    </div>
                                </template>
                                <Column field="origin_currency" header="Moeda de origem"></Column>
                                <Column field="destination_currency" header="Moeda de destino"></Column>
                                <Column field="amount_in_cents" header="Valor para conversão">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.amount_in_cents / 100, 'BRL') }}
                                    </template>
                                </Column>
                                <Column field="payment_method" header="Forma de pagamento">
                                    <template #body="slotProps">
                                        {{
                                            slotProps.data.payment_method === 'credit_card' ? 'Cartão de crédito' : 'Boleto'
                                        }}
                                    </template>
                                </Column>
                                <Column field="value_of_destination_currency"
                                        header="Valor da Moeda de destino">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.value_of_destination_currency, 'BRL') }}
                                    </template>
                                </Column>
                                <Column field="converted_amount" header="Valor comprado em Moeda de destino">
                                    <template #body="slotProps">
                                        {{
                                            formatCurrency(slotProps.data.converted_amount, slotProps.data.destination_currency == 'USD' ? 'USD' : 'EUR')
                                        }}
                                    </template>
                                </Column>
                                <Column field="payment_fee" header="Taxa de pagamento">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.payment_fee / 100, 'BRL') }}
                                    </template>
                                </Column>
                                <Column field="conversion_fee" header="Taxa de conversão">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.conversion_fee / 100, 'BRL') }}
                                    </template>
                                </Column>
                                <Column field="value_of_used_currency"
                                        header="Valor de conversão após as taxas">
                                    <template #body="slotProps">
                                        {{ formatCurrency(slotProps.data.value_of_used_currency, 'BRL') }}
                                    </template>
                                </Column>
                                <Column field="created_at" header="Data de criação">
                                    <template #body="slotProps">
                                        {{ moment(slotProps.data.created_at).format('DD/MM/YYYY HH:mm:ss') }}
                                    </template>
                                </Column>
                                <template #footer> In total there are
                                    {{ listHistorycCurrency ? listHistorycCurrency.length : 0 }} currency conversions.
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div></div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
