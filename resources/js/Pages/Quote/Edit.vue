<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({
    quote: Object,
    sourceCurrencies: Object,
    targetCurrencies: Object,
    paymentMethods: Array
})

const currencyMask = {
    decimal: ',',
    thousands: '.',
    prefix: '$ ',
    precision: 2,
    masked: false
}

const form = useForm({
    source_currency: props.quote.source_currency,
    target_currency: props.quote.target_currency,
    original_amount: props.quote.original_amount,
    payment_method: props.quote.payment_method,
    payment_fee: props.quote.payment_fee,
    conversion_fee: props.quote.conversion_fee,
    converted_amount: props.quote.converted_amount,
    final_amount: props.quote.final_amount,
    value_target_currency: props.quote.value_target_currency,
})

const submit = () => {
    form.put(route('quote.update', props.quote.id), {
        onSuccess: () => {
            router.visit(route('quote.index'))
        },
    })
}


const quotation = async () => {
    if(form.target_currency  === null || form.original_amount  === null || form.payment_method  === null) {
        return
    }
    try{
        const response = await axios.post(route('quote.quotation'), {
            source_currency: form.source_currency,
            target_currency: form.target_currency,
            original_amount: form.original_amount,
            payment_method: form.payment_method,
        })

        form.conversion_fee = response.data.conversion_fee
        form.final_amount = response.data.final_amount
        form.converted_amount = response.data.converted_amount
        form.payment_fee  = response.data.payment_fee
        form.value_target_currency = response.data.value_target_currency
    } catch (error){
        alert('Não foi possível realizar a cotação, revise os parâmetros e tente novamente.')
        form.conversion_fee = null
        form.final_amount = null
        form.converted_amount = null
        form.payment_fee  = null
        form.value_target_currency = null
    }
}

const breadcrumbs = [
    { title: 'Dashboard', disabled: false, href: '/' },
    { title: 'Cotação', disabled: false, href: '/quote' },
    { title: 'Novo', disabled: true },
]
</script>

<template>
    <Head title="Nova Cotação" />
    <AuthenticatedLayout>
        <div class="mb-5">
            <h5 class="text-h5 font-weight-bold">Nova Cotação</h5>
            <Breadcrumbs :items="breadcrumbs" class="pa-0 mt-1" />
        </div>
        <v-card>
            <v-form @submit.prevent="submit">
                <v-card-text>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-autocomplete
                                v-model="form.source_currency"
                                :items="Object.entries(props.sourceCurrencies)"
                                variant="underlined"
                                label="Moeda de origem"
                                :item-title="(value) => value ? `${value[0]} - ${value[1]}` : ''"
                                item-value="0"
                                :error-messages="form.errors.source_currency"
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-autocomplete
                                v-model="form.target_currency"
                                :items="Object.entries(props.targetCurrencies)"
                                variant="underlined"
                                label="Moeda de destino"
                                clearable
                                :item-title="(value) => value ? `${value[0]} - ${value[1]}` : ''"
                                item-value="0"
                                :error-messages="form.errors.target_currency"
                            ></v-autocomplete>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                v-model="form.original_amount"
                                variant="underlined"
                                label="Valor para conversão"
                                v-money="currencyMask"
                                :error-messages="form.errors.original_amount"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-select
                                label="Forma de pagamento"
                                variant="underlined"
                                :items="paymentMethods"
                                item-title="value"
                                item-value="name"
                                v-model="form.payment_method"
                                :onchange="quotation()"
                                :error-messages="form.errors.payment_method"
                            ></v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                v-model="form.value_target_currency"
                                variant="underlined"
                                label="Valor da Moeda de destino"
                                v-money="currencyMask"
                                readonly
                                :error-messages="form.errors.value_target_currency"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                v-model="form.converted_amount"
                                variant="underlined"
                                label='Valor comprado em Moeda de destino'
                                v-money="currencyMask"
                                readonly
                                :error-messages="form.errors.converted_amount"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                v-model="form.payment_fee"
                                variant="underlined"
                                label="Taxa de pagamento"
                                v-money="currencyMask"
                                readonly
                                :error-messages="form.errors.payment_fee"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field
                                v-model="form.conversion_fee"
                                variant="underlined"
                                label="Taxa de conversão"
                                v-money="currencyMask"
                                readonly
                                :error-messages="form.errors.conversion_fee"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field
                                v-model="form.final_amount"
                                variant="underlined"
                                label="Valor utilizado para conversão descontando as taxas:"
                                v-money="currencyMask"
                                readonly
                                :error-messages="form.errors.final_amount"
                            ></v-text-field>
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
