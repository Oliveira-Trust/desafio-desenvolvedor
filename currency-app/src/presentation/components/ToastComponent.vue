<script setup lang="ts">
import type { Toast } from '@/core/types/toast.interface';
import { mdiAlertCircleOutline, mdiAlertOutline, mdiCheckCircleOutline, mdiInformationOutline } from '@mdi/js';
import { onMounted, ref, watch } from 'vue';

const emit = defineEmits<{
    (e: 'update:visible', id: string): void;
}>();

const props = defineProps<Toast>();
const visible = ref(props.visible);

const icons = {
    success: mdiCheckCircleOutline,
    error: mdiAlertCircleOutline,
    info: mdiInformationOutline,
    warning: mdiAlertOutline,
};

const titles = {
    success: 'Sucesso',
    error: 'Erro',
    info: 'Informação',
    warning: 'Aviso',
};

onMounted(() => {
    if (props.timeout && props.timeout > 0) {
        setTimeout(() => {
            visible.value = false;
        }, props.timeout);
    }
});

watch(visible, (value: boolean) => {
    if (!value) {
        emit('update:visible', props.id as string);
    }
});
</script>

<template>
    <div class="toast" :class="`toast--${type}`" @click="visible = false">
        <div class="toast__icon">
            <VIcon :icon="icons[type]" />
        </div>
        <div class="toast__content">
            <div class="toast__title">
                {{ titles[type] }}
            </div>
            <div class="toast__message">
                {{ message }}
            </div>
        </div>
        <div class="toast__progress-bar"></div>
    </div>
</template>

<style scoped lang="scss">
.toast {
    position: relative;
    display: flex;
    flex-direction: row;
    width: 350px;
    padding: 12px;
    border-radius: 8px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
    margin-bottom: 8px;
    pointer-events: auto;
    cursor: pointer;
    overflow: hidden;
    transition: background 200ms ease-in-out;

    &__icon {
        margin-right: 8px;
        .v-icon {
            font-size: 24px;
            color: rgb(255, 255, 255);
        }
    }

    &__content {
        width: 100%;
    }

    &__title {
        font-weight: 600;
        text-transform: capitalize;
        color: rgb(255, 255, 255);
    }

    &__message {
        font-weight: 400;
        color: rgb(255, 255, 255);
    }

    &__progress-bar {
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        animation: progress v-bind('`${timeout}ms`');
        color: rgb(255, 255, 255);
        background-color: rgba(255, 255, 255, var(--v-high-emphasis-opacity));
    }

    &--success {
        background-color: rgba(var(--v-theme-success), var(--v-high-emphasis-opacity));
        &:hover {
            background-color: rgba(var(--v-theme-success), var(--v-high-emphasis-opacity));
        }
    }

    &--error {
        background-color: rgba(var(--v-theme-error), var(--v-high-emphasis-opacity));
        &:hover {
            background-color: rgba(var(--v-theme-error), 1);
        }
    }

    &--info {
        background-color: rgba(var(--v-theme-info), var(--v-high-emphasis-opacity));
        &:hover {
            background-color: rgba(var(--v-theme-info), 1);
        }
    }

    &--warning {
        background-color: rgba(var(--v-theme-warning), var(--v-high-emphasis-opacity));
        &:hover {
            background-color: rgba(var(--v-theme-warning), 1);
        }
    }
}

@keyframes progress {
    from {
        width: 0;
    }

    to {
        width: 100%;
    }
}
</style>
