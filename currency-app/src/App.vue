<script setup lang="ts">
import { RouterView } from 'vue-router';
import ToastManager from './presentation/components/ToastManager.vue';
import { useAuthStore } from './core/stores/auth.store';
import { computed } from 'vue';

const loading = computed(() => useAuthStore().checkingAuthentication);
</script>

<template>
    <VApp id="inspire">
        <VOverlay :model-value="loading" class="loading-application" >
            <VProgressCircular
                color="primary"
                size="64"
                indeterminate
            />
        </VOverlay>

        <ToastManager />
        <RouterView />
    </VApp>
</template>

<style scoped lang="scss">
.loading-application {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>