<template>
    <select @change="$emit('change', $event.target.value)" :value="value">
        <option value="" v-if="canBeEmpty">Selecione...</option>
        <slot/>
    </select>
</template>

<script lang="ts">
import Vue from 'vue'
export default Vue.extend({
    props: { canBeEmpty: Boolean, value: String },
})
</script>

<style scoped>
select { @apply rounded text-sm w-full; }
</style>
