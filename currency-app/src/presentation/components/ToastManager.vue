<script setup lang="ts">
import { useToastStore } from '@/core/stores/toast.store';
import { computed } from 'vue';
import ToastComponent from './ToastComponent.vue';

const toastStore = useToastStore();
const toasts = computed(() => toastStore.toasts);

function removeToast(id: string) {
    toastStore.removeToast(id);
}
</script>

<template>
    <div class="toast-manager">
        <TransitionGroup name="scroll-y-transition" appear>
            <ToastComponent v-for="toast in toasts" :key="toast.id" v-bind="toast" @update:visible="removeToast" />
        </TransitionGroup>
    </div>
</template>

<style scoped lang="scss">
.toast-manager {
    position: fixed;
    top: env(safe-area-inset-top, 0px);
    right: env(safe-area-inset-right, 0px);
    left: env(safe-area-inset-left, 0px);
    z-index: 10000;
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-end;
    margin: 0px auto;
    padding: 16px;
    pointer-events: none;
}
</style>
