<script setup lang="ts">
import { RouterView } from 'vue-router';
import ToastManager from './presentation/components/ToastManager.vue';
</script>

<template>
    <VApp id="inspire">
        <ToastManager />
        <RouterView />
    </VApp>
</template>
