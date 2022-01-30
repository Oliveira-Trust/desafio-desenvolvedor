<template>
    <div class="form-group"><slot/></div>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({

})
</script>

<style scoped>
div.form-group { @apply flex flex-col sm:flex-row space-y-3 sm:space-y-0 space-x-0 sm:space-x-5 justify-between; }
</style>
