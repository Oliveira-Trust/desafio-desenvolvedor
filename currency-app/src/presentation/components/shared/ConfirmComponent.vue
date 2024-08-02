<script setup lang="ts">
import { computed, useSlots, type PropType } from 'vue';
import DialogComponent from './DialogComponent.vue';

/**
 * DEFINIÇÕES DO COMPONENTE
 */
const modelValue = defineModel<boolean>({
    required: false,
    default: false,
});

defineOptions({
    inheritAttrs: false,
});

defineProps({
    message: {
        type: String,
        required: false,
    },
    cancelText: {
        type: String,
        default: 'Cancelar',
    },
    confirmText: {
        type: String,
        default: 'Confirmar',
    },
    cancelVariant: {
        type: String as PropType<'outlined' | 'flat' | 'text' | 'elevated' | 'tonal' | 'plain' | undefined>,
        default: 'Cancelar',
    },
    confirmVariant: {
        type: String as PropType<'outlined' | 'flat' | 'text' | 'elevated' | 'tonal' | 'plain' | undefined>,
        default: 'Confirmar',
    },
    maxWidth: {
        type: Number,
        default: 400,
    },
    titleAlign: {
        type: String as PropType<'start' | 'center'>,
        default: 'center',
    },
});

const slots = useSlots();
const bHasDefalutSlot = computed(() => !!slots.default);

const emit = defineEmits<{
    (e: 'confirm'): void;
    (e: 'cancel'): void;
}>();

/**
 * VARIÁVEIS DE CONTROLE
 */

function onConfirm() {
    emit('confirm');
}

function onCancel() {
    emit('cancel');
}
</script>

<template>
    <DialogComponent v-bind="$attrs" v-model="modelValue" :maxWidth :titleAlign show-cancel-button show-confirm-button persistent>
        <template v-slot:activator="scope">
            <slot name="activator" v-bind="scope"></slot>
        </template>

        <slot v-if="bHasDefalutSlot" name="default"></slot>
        <div v-else class="text-center">{{ message }}</div>

        <template #actions>
            <VRow>
                <VCol>
                    <VBtn
                        size="large"
                        color="primary"
                        rounded="lg"
                        :text="cancelText"
                        :variant="cancelVariant"
                        @click="onCancel"
                        block
                    />
                </VCol>
                <VCol>
                    <VBtn
                        size="large"
                        color="primary"
                        rounded="lg"
                        :text="confirmText"
                        :variant="confirmVariant"
                        @click="onConfirm"
                        block
                    />
                </VCol>
            </VRow>
        </template>
    </DialogComponent>
</template>

<style scoped lang="scss"></style>
