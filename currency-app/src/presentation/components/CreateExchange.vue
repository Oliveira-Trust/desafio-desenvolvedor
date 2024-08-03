<script setup lang="ts">
import {useToastStore} from '@/core/stores/toast.store';
import DialogComponent from '@/presentation/components/shared/DialogComponent.vue';
import InputField from '@/presentation/components/shared/form/InputField.vue';
import {ref, onMounted, computed, reactive} from 'vue';
import type {VForm} from 'vuetify/components';
import SelectField from "@/presentation/components/shared/form/SelectField.vue";
import type { ICreateExchange} from "@/domain/entities/exchange.model";
import {AxiosError} from "axios";
import { useExchangeStore } from '@/core/stores/exchange.store';

/**
 * DEFINIÇÕES DO COMPONENTE
 */
const showing = defineModel<boolean>({
    required: false,
    default: false,
});

const localExchange = reactive<ICreateExchange>({
    sourceCurrency: 'BRL',
    destinationCurrency: 'USD',
    paymentMethod: 'billet',
    originalAmount: 8000,
});

/**
 * STORES
 */
const exchangeStore = useExchangeStore();

const currencies = computed(() => useExchangeStore().currencies);
const paymentMethods = [
    {title: 'Boleto', value: 'billet'},
    {title: 'Cartão de crédito', value: 'credit_card'}
]

/**
 * VARIÁVEIS DE CONTROLE
 */
const bIsValidForm = ref(false);
const loading = ref(false);

/**
 * MÉTODOS
 */
async function onSubmitHandler() {
    loading.value = true;
    try {
        if (bIsValidForm.value) {
            await exchangeStore.createExchange(localExchange);
            useToastStore().success('Conversão realizada com sucesso');
            localExchange.sourceCurrency = 'BRL';
            localExchange.destinationCurrency = 'USD';
            localExchange.paymentMethod = 'billet';
            localExchange.originalAmount = 8000;
            showing.value = false;
        }
    } catch (error: unknown) {
        if (error instanceof AxiosError) {
            if (error.response?.status === 400) {
                useToastStore().error(`Não foi possível converter a moeda de ${localExchange.sourceCurrency} para ${localExchange.destinationCurrency}`);
            }
        } else if (error instanceof Error) {
            useToastStore().error(error.message);
        }
    } finally {
        loading.value = false;
    }
}

function onCancelHandler() {
    showing.value = false;
}

onMounted(() => {
    exchangeStore.fetchCoins()
})
</script>

<template>
    <DialogComponent
        v-model="showing"
        title="Nova conversão"
        :loading="loading"
        show-close-button
    >
        <template v-slot:activator="scope">
            <slot name="activator" v-bind="scope"></slot>
        </template>

        <template #default>
            <VForm id="form" v-model="bIsValidForm" @submit.prevent="onSubmitHandler">
                <VRow>
                    <VCol cols="12">
                        <SelectField
                            label="Moeda de origem"
                            v-model="localExchange.sourceCurrency"
                            variant="outlined"
                            density="compact"
                            :items="currencies"
                            item-title="name"
                            item-value="code"
                            hide-details="auto"
                            disabled
                        />
                    </VCol>
                    <VCol cols="12">
                        <SelectField
                            label="Moeda de destino"
                            v-model="localExchange.destinationCurrency"
                            variant="outlined"
                            density="compact"
                            :items="currencies"
                            item-title="name"
                            item-value="code"
                            hide-details="auto"
                        />
                    </VCol>
                    <VCol cols="12">
                        <SelectField
                            label="Método de pagamento"
                            v-model="localExchange.paymentMethod"
                            variant="outlined"
                            density="compact"
                            :items="paymentMethods"
                            hide-details="auto"
                        />
                    </VCol>
                    <VCol cols="12">
                        <InputField
                            label="Valor para conversão"
                            v-model.number="localExchange.originalAmount"
                            type="number"
                            variant="outlined"
                            density="compact"
                            :items="currencies"
                            item-title="name"
                            item-value="code"
                            hide-details="auto"
                            step="0.01"
                        >
                            <template #prepend-inner>R$</template>
                        </InputField>
                    </VCol>
                </VRow>
            </VForm>
        </template>

        <template #actions>
            <VRow>
                <VCol>
                    <VBtn
                        size="large"
                        color="primary"
                        rounded="lg"
                        text="Cancelar"
                        variant="outlined"
                        :disabled="loading"
                        @click="onCancelHandler"
                        block
                    />
                </VCol>
                <VCol>
                    <VBtn
                        form="form"
                        type="submit"
                        size="large"
                        color="primary"
                        rounded="lg"
                        text="Salvar"
                        variant="flat"
                        :disabled="loading"
                        block
                    />
                </VCol>
            </VRow>
        </template>
    </DialogComponent>
</template>

<style scoped lang="scss">
</style>
