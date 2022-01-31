<template>
    <div class="conversions-list">
        <conversion-card class="mx-auto w-full" v-for="(conversion, index) in conversions" :key="index"
            :conversion="conversion" />
    </div>
</template>

<script lang="ts">
import Vue from 'vue'

import Conversion from '~/types/Conversion';
import ConversionCard from '../cards/ConversionCard.vue';

export default Vue.extend({
    components: { ConversionCard },
    computed: {
        conversions(): Array<Conversion> {
            let conversions: Array<Conversion> = this.$store.state.conversions.conversoes
            return conversions;
        }
    },
    mounted(): void {
        this.updateConversions();
    },
    methods: {
        updateConversions(): void {
            this.$axios.$get('/laravel/api/conversions')
                .then(res => this.$store.commit('conversions/setConversoes', res))
        }
    }
})
</script>

<style scoped>
.conversions-list { @apply w-full grid grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-3 overflow-hidden overflow-x-auto; }
</style>
