<template>
    <Card>
        <div class="mx-auto md:max-w-2xl">
            <div class="card-title">
                <span>Conversor de Moedas</span>
            </div>

            <div class="mt-10">
                <conversor />

                <div class="mt-2">
                    <Card>
                        <div class="card-title">
                            <span>Realizar conversão de moeda</span>
                        </div>

                        <div class="flex flex-col space-y-1">
                            <span>Formas de pagamento</span>
                            <div class="flex flex-col space-y-1">

                            </div>
                        </div>

                    </Card>
                </div>
            </div>
        </div>

    </Card>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from '~/components/Card.vue'
import Conversor from '~/components/Conversor.vue'

export default Vue.extend({
    name: "IndexPage",
    components: { Card, Conversor },
    async asyncData({ $axios, store }) {
        if (!store.state.exchange.moedas.length) {
            $axios.$get('api/coins', { params: { with: 'prices,conversions' }})
            .then(data => store.commit('exchange/setMoedas', data.data));
        }
    }
})
</script>

<style scoped>
.card-title { @apply text-center; }
</style>
