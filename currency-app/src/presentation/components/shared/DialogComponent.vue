<script setup lang="ts">
import { computed, useSlots, type PropType } from 'vue';
import { mdiClose } from '@mdi/js';

const slots = useSlots();

const bHasActionsSlot = computed(() => !!slots.actions);
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
    title: {
        type: String,
    },
    showCloseButton: {
        type: Boolean,
        default: false,
    },
    loading: {
        type: Boolean,
        default: false,
    },
    titleAlign: {
        type: String as PropType<'start' | 'center'>,
        default: 'start',
    },
    persistent: {
        type: Boolean,
        default: true,
    },
    maxWidth: {
        type: Number,
        default: 500,
    },
});
</script>

<template>
    <VDialog v-bind="$attrs" v-model="modelValue" :maxWidth :close-on-content-click="false" :persistent>
        <template v-slot:activator="scope">
            <slot name="activator" v-bind="scope"></slot>
        </template>

        <template v-slot:default="{ isActive }">
            <VCard :loading="loading ? 'primary' : false" :disabled="loading">
                <VCardTitle v-if="title" class="dialog__header" :class="`dialog__header--${titleAlign}`">
                    {{ title }}
                    <VBtn v-if="showCloseButton" :icon="mdiClose" variant="text" @click="isActive.value = false"></VBtn>
                </VCardTitle>

                <VDivider />

                <div class="dialog__body">
                    <slot name="default" :isActive="isActive"></slot>
                </div>

                <VDivider v-if="bHasActionsSlot" />
                <template v-if="bHasActionsSlot" v-slot:actions>
                    <slot name="actions"></slot>
                </template>
            </VCard>
        </template>
    </VDialog>
</template>

<style scoped lang="scss">
.dialog {
    &__header {
        padding: 8px 16px;
        display: flex;
        align-items: center;
        min-height: 64px;

        &--start {
            justify-content: space-between;
        }

        &--center {
            justify-content: center;
        }
    }

    &__body {
        max-height: 600px;
        overflow-y: auto;
        padding: 32px 48px;
        :deep(.v-btn) {
            margin-bottom: 16px;
        }
    }
}

:deep(.v-card-actions) {
    padding: 32px 48px 32px 48px;
}
</style>
