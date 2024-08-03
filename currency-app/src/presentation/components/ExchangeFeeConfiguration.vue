<script setup lang="ts">
import {useToastStore} from '@/core/stores/toast.store';
import DialogComponent from '@/presentation/components/shared/DialogComponent.vue';
import InputField from '@/presentation/components/shared/form/InputField.vue';
import {ref, onMounted, reactive} from 'vue';
import type {VForm} from 'vuetify/components';
import DatePickerField from "@/presentation/components/shared/form/DatePickerField.vue";
import type {IExchangeFeeConfiguration} from "@/domain/entities/exchange-fee-configuration.model";
import {useExchangeFeeConfigurationStore} from "@/core/stores/exchange-fee-configuration.store";

/**
 * DEFINIÇÕES DO COMPONENTE
 */
const showing = defineModel<boolean>({
    required: false,
    default: false,
});

const localFeeConfiguration = reactive<IExchangeFeeConfiguration>({
    amount: 0,
    gtThreshold: 0,
    ltThreshold: 0,
    effectiveDate: new Date(),
});

/**
 * STORES
 */
const store = useExchangeFeeConfigurationStore();

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
            await store.saveConfiguration(localFeeConfiguration);
            useToastStore().success('Conversão realizada com sucesso');
            showing.value = false;
        }
    } catch (error: unknown) {
        if (error instanceof Error) {
            useToastStore().error(error.message);
        }
    } finally {
        loading.value = false;
    }
}

function onCancelHandler() {
    showing.value = false;
}

onMounted(async () => {
    await store.fetchConfiguration()
    if (store.feeConfiguration) {
        localFeeConfiguration.ltThreshold = store.feeConfiguration.ltThreshold
        localFeeConfiguration.gtThreshold = store.feeConfiguration.gtThreshold
        localFeeConfiguration.amount = store.feeConfiguration.amount
        localFeeConfiguration.effectiveDate = store.feeConfiguration.effectiveDate
    }
})
</script>

<template>
    <DialogComponent
        v-model="showing"
        title="Configuração de conversão"
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
                        <InputField
                            label="Limite de montante"
                            v-model.number="localFeeConfiguration.amount"
                            type="number"
                            variant="outlined"
                            density="compact"
                            step="0.01"
                            min="0"
                            hide-details="auto"
                        />
                    </VCol>
                    <VCol cols="12">
                        <InputField
                            label="Taxa de conversão inferior"
                            v-model.number="localFeeConfiguration.ltThreshold"
                            type="number"
                            variant="outlined"
                            density="compact"
                            step="0.01"
                            min="0"
                            hide-details="auto"
                        >
                            <template #append-inner>%</template>
                        </InputField>
                    </VCol>
                    <VCol cols="12">
                        <InputField
                            label="Taxa de conversão superior"
                            v-model.number="localFeeConfiguration.gtThreshold"
                            type="number"
                            variant="outlined"
                            density="compact"
                            step="0.01"
                            min="0"
                            hide-details="auto"
                        >
                            <template #append-inner>%</template>
                        </InputField>
                    </VCol>
                    <VCol cols="12">
                        <DatePickerField
                            label="Data de efetivação"
                            v-model="localFeeConfiguration.effectiveDate"
                            variant="outlined"
                            density="compact"
                            hide-details="auto"
                        />
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
