<script setup>

defineProps({
    size: {
        type: Number,
        default: 8,
    },
})

</script>
<template>
    <v-icon icon="mdi mdi-cash-sync" color="secondary" :size="size + 'rem'"></v-icon>
</template>
