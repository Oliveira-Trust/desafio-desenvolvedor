<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    quotations: Object,
});

const breadcrumbs = [
    { title: 'Dashboard', disabled: false, href: '/' },
    { title: 'Cotações', disabled: true }
]

const headers = [
    { title: 'Moeda de Origem', key: 'source_currency' },
    { title: 'Moeda de Destino', key: 'target_currency' },
    { title: 'Valor Original', key: 'original_amount' },
    { title: 'Valor Convertido', key: 'converted_amount' },
    { title: 'Valor Final', key: 'final_amount' },
    { title: 'Ações', key: 'action', sortable: false }
]

const isLoadingTable = ref(false)
const search = ref(null)
const deleteDialog = ref(false)
const isLoading = ref(false)
const deleteId = ref(null)

const loadItems = ({ page, itemsPerPage, sortBy, search }) => {
    isLoadingTable.value = true
    let params = {
        page: page,
        limit: itemsPerPage,
        sort: sortBy[0],
    }
    if (search) {
        params.search = search
    }
    router.get('/quote', params, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            isLoadingTable.value = false
        },
    })
}

const deleteItem = (item) => {
    deleteId.value = item.id
    deleteDialog.value = true
}

const submitDelete = () => {
    isLoading.value = true
    router.delete('/quote/' + deleteId.value, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            isLoading.value = false
            deleteDialog.value = false
        },
    })
}

const isMobile = ref(false)
const checkResolution = () => {
    isMobile.value = window.innerWidth <= 768
}

onMounted(() => {
    checkResolution()
    window.addEventListener('resize', checkResolution)
})

onUnmounted(() => {
    window.removeEventListener('resize', checkResolution)
})

const formatCurrency = (value, currency = 'BRL', locale = 'pt-BR') => {
    if (value !== null && value !== undefined) {
        return new Intl.NumberFormat(locale, { style: 'currency', currency }).format(value);
    }
    return null;
};
</script>

<template>
    <Head title="Cotações" />
    <AuthenticatedLayout>
        <div class="mb-5">
            <h5 class="text-h5 font-weight-bold">Cotações</h5>
            <Breadcrumbs :items="breadcrumbs" class="pa-0 mt-1" />
        </div>
        <v-card class="pa-4">
            <div class="d-flex flex-wrap align-center">
                <v-text-field
                    v-model="search"
                    label="Buscar"
                    variant="underlined"
                    prepend-inner-icon="mdi-magnify"
                    hide-details
                    clearable
                    single-line
                />
                <v-spacer />
                <Link :href="route('quote.create')" as="div">
                    <v-btn color="primary">Novo</v-btn>
                </Link>
            </div>
            <v-data-table-server
                :items="quotations.data"
                :items-length="quotations.total"
                :headers="headers"
                :search="search"
                class="elevation-0"
                :loading="isLoadingTable"
                @update:options="loadItems"
                :items-per-page-options="[10, 25, 50, 100]"
                :mobile="isMobile"
            >
                <template #[`item.source_currency`]="{ item }">
                    {{ item.source_currency }}
                </template>
                <template #[`item.original_amount`]="{ item }">
                    {{ formatCurrency(item.original_amount, item.source_currency) }}
                </template>
                <template #[`item.payment_fee`]="{ item }">
                    {{ item.payment_fee.replace('.', ',') + '%' }}
                </template>
                <template #[`item.conversion_fee`]="{ item }">
                    {{ item.conversion_fee.replace('.', ',') + '%' }}
                </template>
                <template #[`item.converted_amount`]="{ item }">
                    {{ formatCurrency(item.converted_amount, item.target_currency) }}
                </template>
                <template #[`item.final_amount`]="{ item }">
                    {{ formatCurrency(item.final_amount, item.source_currency) }}
                </template>
                <template #[`item.action`]="{ item }">
                    <Link :href="route('quote.edit', item.id)" as="button">
                        <v-icon color="warning" icon="mdi-pencil" />
                    </Link>
                    <v-icon class="ml-2" color="error" icon="mdi-delete" @click="deleteItem(item)" />
                </template>
            </v-data-table-server>
        </v-card>
        <v-row justify="center">
            <v-dialog v-model="deleteDialog" persistent width="auto">
                <v-card>
                    <v-card-text>Tem certeza que deseja excluir?</v-card-text>
                    <v-card-actions>
                        <v-spacer />
                        <v-btn color="error" variant="text" @click="deleteDialog = false">Cancelar</v-btn>
                        <v-btn color="primary" :loading="isLoading" variant="text" @click="submitDelete">Excluir</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </AuthenticatedLayout>
</template>
