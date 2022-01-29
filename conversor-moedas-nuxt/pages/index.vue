<template>
    <Card>
        <h1>Esta será a seção Main</h1>
    </Card>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from '~/components/Card.vue'

export default Vue.extend({
    name: "IndexPage",
    components: { Card }
})
</script>

<style scoped>

</style>
