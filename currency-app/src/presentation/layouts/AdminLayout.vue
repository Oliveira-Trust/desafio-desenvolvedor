<script setup lang="ts">
import {mdiCog, mdiLogout, mdiPlus} from '@mdi/js';
import logoOt from '@/assets/logo.svg';
import router from "@/router";
import {ref} from "vue";
import {useAuthStore} from "@/core/stores/auth.store";
import ExchangeFeeConfiguration from "@/presentation/components/ExchangeFeeConfiguration.vue";

const loading = ref(false);
async function onLogoutHandler() {
    loading.value = true;

    try {
        await useAuthStore().logout();
        await router.push({name: 'home'})
    } catch (error: unknown) {
        if (error instanceof Error) {
            //
        }
    }

    loading.value = false;
}
</script>

<template>
    <VAppBar class="px-md-4" flat>
        <template #prepend>
            <VAppBarNavIcon v-if="$vuetify.display.smAndDown" />
        </template>

        <VImg class="me-sm-8" max-width="180" :src="logoOt" />

        <VSpacer />

        <ExchangeFeeConfiguration>
            <template #activator="{ props }">
                <VBtn v-bind="props" :icon="mdiCog" />
            </template>
        </ExchangeFeeConfiguration>

        <VBtn :icon="mdiLogout" @click="onLogoutHandler" />
    </VAppBar>

    <VMain class="mt-8">
        <VContainer>
            <RouterView />
        </VContainer>
    </VMain>
</template>

<style scoped lang="scss"></style>
