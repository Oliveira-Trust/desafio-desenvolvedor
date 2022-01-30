<template>
    <div class="input-group"><slot/></div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({

})
</script>

<style scoped>
div.input-group { @apply flex flex-col w-full space-y-1; }
</style>
