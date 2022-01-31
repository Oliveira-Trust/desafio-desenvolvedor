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
    mounted(): void {
        this.setMoedas()
    },
    methods: {
        setMoedas(): void {
            this.$axios.$get('/laravel/api/coins', { params: { with: 'prices,conversions' }})
                .then(data => this.$store.commit('exchange/setMoedas', data.data))
                .catch(err => window.console.warn('A rota de configuração para proxy em nuxt.config.ts está errada.'));
        }
    }
})
</script>

<style scoped>
.card-title { @apply text-center; }
</style>
