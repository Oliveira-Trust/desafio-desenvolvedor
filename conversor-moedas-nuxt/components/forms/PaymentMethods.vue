<template>
    <div class="flex flex-col">
        <span class="text-xl">Formas de pagamento</span>

        <div class="mt-5 space-y-2">
            <div class="flex items-center" v-for="metodoPagamento in paymentMethods" :key="metodoPagamento.id">
                <input type="radio" :id="`metodoPagamento-${metodoPagamento.name}`" name="metodoPagamento"
                    :value="metodoPagamento" v-model="paymentMethod">
                <label :for="`metodoPagamento-${metodoPagamento.name}`" class="ml-2">
                    <span>{{ metodoPagamento.name }}</span>
                    <em class="ml-1 text-xs">{{ `(Taxa: ${metodoPagamento.tax}%)` }}</em>
                </label>
            </div>
        </div>

        <div class="flex mt-10 justify-center">
            <div @click="storeExchange">
                <button-vue>Exchange!</button-vue>
            </div>
        </div>

        <div v-if="errors" class="errors">
            <div v-for="(error, index) in errors" :key="index">
                <ul>
                    <li v-for="(message, messageKey) in error" :key="messageKey">{{ message }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Coin from '~/types/Coin';
import CoinPrice from '~/types/CoinPrice';
import ButtonVue from '~/components/Button.vue';

import PaymentMethod from '~/types/PaymentMethod';

export default Vue.extend({
    components: { ButtonVue },
    computed: {
        hasErros(): Boolean {
            return Boolean(this.errors?.length);
        },
        paymentMethods(): Array<PaymentMethod> {
            return this.$store.state.paymentMethods.metodosPagamento;
        },
        paymentMethodId(): Number {
            let paymentMethod: PaymentMethod = this.paymentMethod;
            return paymentMethod.id;
        },
        valorBase(): Number {
            return this.$store.state.exchange.valorBase;
        },
        coinPriceId(): Number {
            if (!Boolean(this.$store.state.exchange.moedaConversao.length)) return 0;

            let moedas: Array<Coin> = this.$store.state.exchange.moedas;
            let moedaBase: Coin = moedas.filter((moeda: Coin) => moeda.name === this.$store.state.exchange.moedaBase)[0];

            let precoMoedaConversao = moedaBase.coin_prices
                ?.filter((coinPrice: CoinPrice) => coinPrice?.coin_convert?.name === this.$store.state.exchange.moedaConversao)[0];

            return Number(precoMoedaConversao?.id);
        },

    },
    data(): Object {
        let paymentMethod: PaymentMethod = new PaymentMethod();
        return { paymentMethod, errors: [] };
    },
    mounted(): void {
        this.setFormasPagamento()
    },
    methods: {
        setFormasPagamento(): void {
            this.$axios.$get('/laravel/api/payment-methods')
                .then(data => this.$store.commit('paymentMethods/setMetodosPagamento', data.data));
        },
        storeExchange(): void {
            this.errors = [];
            let data = {
                coin_price_id: this.coinPriceId,
                payment_method_id: this.paymentMethodId,
                value: this.valorBase
            }
            this.$axios.$post('/laravel/api/conversions', data)
                .then(response => {}) // TODO - Adicionar listagem.
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }
                })
        }

    }
})
</script>

<style scoped>
.errors { @apply mt-5 space-y-2; }
.errors > div { @apply border rounded border-red-600 text-red-500 bg-red-200 px-3 py-2; }
.errors > div > ul { @apply list-none space-y-1; }
.errors > div > ul > li { @apply list-none space-y-1; }
</style>
