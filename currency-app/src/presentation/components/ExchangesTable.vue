<script setup lang="ts">
import {computed, ref} from 'vue';
import type {DataTableHeaders} from "@/core/types/data-table-headers.type";
import { useExchangeStore } from '@/core/stores/exchange.store';

const store = useExchangeStore();

const headers = ref<DataTableHeaders>([
    {
        title: 'Data de conversão',
        align: 'start',
        sortable: false,
        key: 'createdAt',
        minWidth: '50px',
        width: '175px'
    },
    {
        title: 'Origem',
        align: 'start',
        sortable: false,
        key: 'sourceCurrency',
        width: '100px',
    },
    {
        title: 'Destino',
        align: 'start',
        sortable: false,
        key: 'destinationCurrency',
        minWidth: '100px',
    },
    {
        title: 'Método',
        align: 'center',
        sortable: false,
        key: 'paymentMethod',
    },
    {
        title: 'Valor',
        align: 'start',
        sortable: false,
        key: 'originalAmount',
    },
    {
        title: 'Tx. método de pagemento',
        align: 'start',
        sortable: false,
        key: 'paymentFee',
    },
    {
        title: 'Tx. de conversão',
        align: 'start',
        sortable: false,
        key: 'conversionFee',
    },
    {
        title: 'Valor final',
        align: 'start',
        sortable: false,
        key: 'totalWithFees',
    },
]);

const page = ref(1);
const itemsPerPage = ref(1000);
const totalItems = ref(1000);
const loading = ref(false);

const exchanges = computed(() => store.exchanges);

async function loadItems() {
    loading.value = true;
    try {
        await store.fetchExchanges();
    } catch (error: unknown) {
        if (error instanceof Error) {
            // useToastStore().error(error.message);
        }
    }
    loading.value = false;
}
</script>

<template>
    <VCard rounded="lg" flat>
        <VDataTableServer
            v-model:page="page"
            v-model:items-per-page="itemsPerPage"
            :headers="headers"
            :items="exchanges"
            :items-length="totalItems"
            :loading
            density="compact"
            @update:options="loadItems"
        >
            <template #[`item.originalAmount`]="{ value }">
                R$ {{ value.toFixed(2).toString().replace('.', ',') }}
            </template>
            <template #[`item.paymentMethod`]="{ value }">
                {{ value === 'billet' ? 'Boleto' : 'Cartão de crédito' }}
            </template>
            <template #[`item.totalWithFees`]="{ value }">
                R$ {{ value.toFixed(2).toString().replace('.', ',') }}
            </template>
            <template #[`item.paymentFee`]="{ item }">
                R$ {{ item.paymentFee.toFixed(2).toString().replace('.', ',') }}
            </template>
            <template #[`item.conversionFee`]="{ item }">
                R$ {{ item.conversionFee.toFixed(2).toString().replace('.', ',') }}
            </template>
            <template #[`item.createdAt`]="{ value }">
                {{ value.toLocaleString() }}
            </template>
            <template #bottom></template>
        </VDataTableServer>
    </VCard>
</template>

<style scoped lang="scss">
</style>
