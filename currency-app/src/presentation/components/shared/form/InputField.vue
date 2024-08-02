<script setup lang="ts">
import { mdiCloseCircle } from '@mdi/js';
import { computed, ref, type Component, type PropType } from 'vue';
import { VTextField } from 'vuetify/components';

defineOptions({
    inheritAttrs: true,
});

withDefaults(
    defineProps<{
        component?: PropType<Component>;
        label?: string;
        labelPlacement?: 'top' | 'start';
        variant?: 'underlined' | 'filled' | 'outlined' | 'plain' | 'solo' | 'solo-inverted' | 'solo-filled';
        density?: 'default' | 'comfortable' | 'compact';
    }>(),
    {
        component: VTextField,
        label: '',
        labelPlacement: 'top',
        variant: 'outlined',
        density: 'compact',
    },
);

const inputRef = ref();
const color = computed(() => `text-${inputRef.value?.color}`);
</script>

<template>
    <div>
        <div v-if="!!label && labelPlacement === 'top'" class="label label--top" :class="color">
            {{ label }}
        </div>
        <component ref="inputRef" :is="component" v-bind="$attrs" :variant :density>
            <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                <slot :name="slot" v-bind="scope" />
            </template>

            <template v-if="!!label && labelPlacement === 'start'" #prepend>
                <div class="label label--start">
                    {{ label }}
                </div>
            </template>

            <template #message="{ message }">
                <div class="error">
                    <VIcon :icon="mdiCloseCircle" class="error__icon" />
                    <span class="error__message" :class="color">{{ message }}</span>
                </div>
            </template>
        </component>
    </div>
</template>

<style scoped lang="scss">
.label {
    font-weight: 400;
    &--top {
        margin-bottom: 8px;
    }
}

:deep(.v-input__details) {
    padding-left: 4px;
}

.error {
    display: flex;
    align-items: center;
    gap: 4px;
    &__icon {
        font-size: 16px;
        color: rgb(var(--v-theme-error));
    }
}
</style>
