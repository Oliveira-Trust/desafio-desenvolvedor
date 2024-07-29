<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps({
    taxSettings: Array
})
console.log(props.taxSettings)
const breadcrumbs = [
    { title: 'Dashboard', disabled: false, href: '/' },
    { title: 'Lista', disabled: true}
]

</script>

<template>
    <Head title="Configuração de Taxas" />
    <AuthenticatedLayout>
        <div class="mb-5">
            <h5 class="text-h5 font-weight-bold">Configuração de Taxas</h5>
            <Breadcrumbs :items="breadcrumbs" class="pa-0 mt-1" />
        </div>
        <v-card class="pa-4">
            <v-table>
                <thead>
                <tr>
                    <th class="text-center">Taxa de Boleto</th>
                    <th class="text-center">Taxa de Cartão de Crédito</th>
                    <th class="text-center">Taxa abaixo de R$ 3.000,00</th>
                    <th class="text-center">Taxa acima de R$ 3.000,00</th>
                    <th class="text-center">Editar</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in taxSettings"
                    :key="item.id"
                >
                    <td class="text-center">{{ (item.boleto_fee).replace('.', ',') + '%' }}</td>
                    <td class="text-center">{{ (item.credit_card_fee).replace('.', ',') + '%' }}</td>
                    <td class="text-center">{{ (item.conversion_fee_below_3000).replace('.', ',') + '%' }}</td>
                    <td class="text-center">{{ (item.conversion_fee_above_3000).replace('.', ',') + '%' }}</td>
                    <td class="text-center">
                        <Link :href="route('tax-settings.edit', item.id)" as="button">
                            <v-icon color="warning" icon="mdi-pencil" />
                        </Link>
                    </td>
                </tr>
                </tbody>
            </v-table>
        </v-card>
    </AuthenticatedLayout>
</template>
