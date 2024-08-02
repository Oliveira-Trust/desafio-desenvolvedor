<script setup lang="ts">
import { mdiCog, mdiLogout } from '@mdi/js';
</script>

<template>
    <VAppBar class="px-md-4" flat>
        <template #prepend>
            <VAppBarNavIcon v-if="$vuetify.display.smAndDown" @click="drawer = !drawer" />
        </template>

        <VImg class="me-sm-8" max-width="40" src="https://cdn.vuetifyjs.com/docs/images/logos/v.svg" />

        <VSpacer />

        <VBtn :icon="mdiCog"> </VBtn>
        <VBtn :icon="mdiLogout"> </VBtn>
    </VAppBar>

    <VMain>
        <VContainer fluid>
            <RouterView />
        </VContainer>
    </VMain>
</template>

<style scoped lang="scss"></style>
