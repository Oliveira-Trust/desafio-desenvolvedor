<template>
    <card>
        <div id="index">
            <div class="card-title">
                <span>Conversor de Moedas</span>
            </div>

            <div class="mt-10">
                <conversor />

                <div class="mt-10" v-if="loggedIn">
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

                <div class="mt-10" v-if="loggedIn">
                    <div class="text-center">
                        <h2 class="text-2xl">Transações realizadas</h2>
                    </div>

                    <div class="mt-5 w-full">
                        <conversions-list />
                    </div>
                </div>
            </div>
        </div>
    </card>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from '~/components/Card.vue'
import Conversor from '~/components/Conversor.vue'
import PaymentMethods from '~/components/forms/PaymentMethods.vue'
import ConversionsList from '~/components/lists/ConversionsList.vue'

export default Vue.extend({
    name: "IndexPage",
    components: { Card, Conversor, PaymentMethods, ConversionsList },
    computed: {
        getNomeMoeda(): String {
            return this.$store.state.exchange.moedaConversao
        },
        getValor(): Number {
            return this.$store.state.exchange.valorConvertido
        },
        loggedIn(): Boolean {
            return this.$auth.loggedIn;
        },
        hasTransacoes(): Boolean {
            return Boolean(this.$store.state.conversions.conversoes.legnth);
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
