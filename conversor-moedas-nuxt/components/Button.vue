<template>
    <button><slot /></button>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({

})
</script>

<style scoped>
button { @apply px-3 py-2 border rounded; }
button:not(:disabled) { @apply hover:bg-gray-300; }
button:disabled { @apply bg-gray-300 text-gray-600; }
</style>
