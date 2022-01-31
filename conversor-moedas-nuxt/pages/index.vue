<template>
    <card>
        <div id="index">
            <div class="card-title">
                <span>Conversor de Moedas</span>
            </div>

            <div class="mt-10">
                <conversor />

                <div class="mt-10">
                    <card>
                        <div class="card-title-md">
                            <span>Realizar troca de moeda</span>
                        </div>

                        <div class="flex flex-col">
                            <div class="flex flex-col space-y-1 mt-5 mx-auto text-xl">
                                <div class="flex">
                                    <span>Valor:</span>
                                    <span class="ml-2">{{ `${getValor}` + (getNomeMoeda ? ` (${$store.state.exchange.moedaConversao})` : '') }}</span>
                                </div>
                            </div>

                            <div class="mt-10">
                                <payment-methods />
                            </div>
                        </div>
                    </card>
                </div>
            </div>
        </div>

    </Card>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from '~/components/Card.vue'
import Conversor from '~/components/Conversor.vue'
import PaymentMethods from '~/components/forms/PaymentMethods.vue'
import ButtonVue from '~/components/Button.vue'

export default Vue.extend({
    name: "IndexPage",
    components: { Card, Conversor, PaymentMethods, ButtonVue },
    computed: {
        getNomeMoeda(): String {
            return this.$store.state.exchange.moedaConversao
        },
        getValor(): Number {
            return this.$store.state.exchange.valorConvertido
        }
    },
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
#index { @apply mx-auto md:max-w-2xl; }
.card-title { @apply text-center text-3xl font-bold; }
.card-title-md { @apply text-center text-2xl; }
</style>
