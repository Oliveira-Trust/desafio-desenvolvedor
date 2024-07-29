<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'


const props = defineProps({
    taxSettings: Object
})

const form = useForm({
    boleto_fee: props.taxSettings.boleto_fee,
    credit_card_fee: props.taxSettings.credit_card_fee,
    conversion_fee_below_3000: props.taxSettings.conversion_fee_below_3000,
    conversion_fee_above_3000: props.taxSettings.conversion_fee_above_3000,
})

const percentMask = {
    decimal: ',',
    thousands: '.',
    prefix: '',
    suffix: ' %',
    precision: 2,
    masked: false
}

const submit = () => {
    form.put(route('tax-settings.update', props.taxSettings.id), {
        onSuccess: () => {
            router.visit(route('tax-settings.index'))
        },
    })
}

const breadcrumbs = [
    { title: 'Dashboard', disabled: false, href: '/' },
    { title: 'Configuração de Taxas', disabled: false, href: '/tax-settings' },
    { title: 'Novo', disabled: true },
]
</script>

<template>
    <Head title="Nova configuração de Taxas" />
    <AuthenticatedLayout>
        <div class="mb-5">
            <h5 class="text-h5 font-weight-bold">Nova Configuração de Taxa</h5>
            <Breadcrumbs :items="breadcrumbs" class="pa-0 mt-1" />
        </div>
        <v-card>
            <v-form @submit.prevent="submit">
                <v-card-text>
                    <v-row>
                        <v-col cols="12" sm="12" md="3">
                            <v-text-field v-model="form.boleto_fee" v-money="percentMask" label="Taxa de Boleto"
                                          variant="underlined"
                                          :error-messages="form.errors.boleto_fee" />
                        </v-col>
                        <v-col cols="12" sm="12" md="3">
                            <v-text-field v-model="form.credit_card_fee" v-money="percentMask"
                                          label="Taxa de Cartão de Crédito"
                                          variant="underlined"
                                          :error-messages="form.errors.credit_card_fee" />
                        </v-col>
                        <v-col cols="12" sm="12" md="3">
                            <v-text-field v-model="form.conversion_fee_below_3000" v-money="percentMask"
                                          label="Taxa de conversão até R$ 3.000,00"
                                          variant="underlined"
                                          :error-messages="form.errors.conversion_fee_below_3000" />
                        </v-col>
                        <v-col cols="12" sm="12" md="3">
                            <v-text-field v-model="form.conversion_fee_above_3000" v-money="percentMask"
                                          label="Taxa de conversão acima R$ 3.000,00"
                                          variant="underlined"
                                          :error-messages="form.errors.conversion_fee_above_3000" />
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <v-spacer />
                    <Link :href="route('tax-settings.index')" as="div">
                        <v-btn variant="text">Cancelar</v-btn>
                    </Link>
                    <v-btn type="submit" color="primary">Salvar</v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </AuthenticatedLayout>
</template>
