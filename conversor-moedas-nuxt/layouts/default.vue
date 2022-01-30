<template>
    <div class="layout">
        <TheHeader />

        <main>
            <Nuxt />
        </main>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import TheHeader from '~/components/TheHeader.vue'

export default Vue.extend({
    components: { TheHeader }
})
</script>

<style scoped>
.layout { @apply w-full min-h-screen bg-gray-50; }
.layout main { @apply sm:mx-10 mt-5; }
</style>
