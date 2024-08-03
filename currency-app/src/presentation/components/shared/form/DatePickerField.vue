<script setup lang="ts">
import { mdiCalendarOutline } from "@mdi/js";
import { ref } from 'vue';
import { VDatePicker, VIcon, VMenu } from 'vuetify/components';
import InputField from './InputField.vue';

defineOptions({
    inheritAttrs: false,
});

const modelValue = defineModel<Date | null>({
    required: true,
    default: new Date(),
});

withDefaults(
    defineProps<{
        label?: string;
        labelPlacement?: 'top' | 'start';
        variant?: 'underlined' | 'filled' | 'outlined' | 'plain' | 'solo' | 'solo-inverted' | 'solo-filled' | undefined;
        density?: 'default' | 'comfortable' | 'compact' | undefined;
        placeholder?: string;
        hideDetails?: boolean | 'auto';
    }>(),
    {
        labelPlacement: 'top',
        variant: 'outlined',
        density: 'compact',
        placeholder: '__/__/____',
        hideDetails: false,
    },
);

function onUpdateModelValue() {
    openDialog.value = false;
}

const openDialog = ref(false);
</script>

<template>
    <VMenu v-model="openDialog" :close-on-content-click="false">
        <template #activator="{ props }">
            <InputField
                v-bind="props"
                :value="modelValue?.toLocaleDateString()"
                :label="label"
                :labelPlacement
                readonly
                :variant
                :density
                :placeholder
                :hideDetails
            >
                <template #prepend-inner>
                    <VIcon :icon="mdiCalendarOutline" />
                </template>

                <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                    <slot :name="slot" v-bind="scope" />
                </template>
            </InputField>
        </template>
        <VDatePicker v-model:model-value="modelValue" elevation="1" @update:model-value="onUpdateModelValue">
            <template #header></template>
            <template #title></template>
        </VDatePicker>
    </VMenu>
</template>

<style scoped lang="scss">
.label {
    font-weight: 400;
    line-height: 14.52px;
    letter-spacing: 0.01em;
    text-align: left;
    margin-bottom: 12px;
}

:deep(.v-picker-title) {
    display: none;
}
</style>
