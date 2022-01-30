<template>
    <form-group>
        <input-group class="group-inputs">
            <label for="moeda-base">Moeda base</label>
            <input-select id="moeda-base" :value="exchangeState.moedaBase" @change="setLocalMoedaBase">
                <option v-for="coin in moedasBase" :key="coin.id" :value="coin.name">{{ coin.name }}</option>
            </input-select>

            <div class="group-input-money">
                <span v-if="exchangeState.moedaBase">{{ exchangeState.moedaBase }}</span>
                <input type="number" id="valor-base" v-model="valorBase" @input="setValorBase($event.target.value)" />
            </div>
        </input-group>
        <input-group class="group-inputs">
            <label for="moeda-conversao">Moeda para conversão</label>
            <input-select id="moeda-base" :value="exchangeState.moedaConversao"
                @change="setLocalMoedaConversao" :canBeEmpty="true">
                <option v-for="coin in moedasConversao" :key="coin.id" :value="coin.name">{{ coin.name }}</option>
            </input-select>

            <div class="group-input-money">
                <span v-if="exchangeState.moedaConversao">{{ exchangeState.moedaConversao }}</span>
                <input type="number" id="valor-conversao" :value="exchangeState.valorConvertido" disabled />
            </div>
        </input-group>
    </form-group>
</template>

<script lang="ts">
import Vue from 'vue'

import Coin from '~/interfaces/Coin'
import CoinPrice from '~/interfaces/CoinPrice'
import ExchangeState from '~/store/exchange'

import InputSelect from './forms/inputs/InputSelect.vue'
import FormGroup from './forms/sections/FormGroup.vue'
import InputGroup from './forms/sections/InputGroup.vue'

export default Vue.extend({
    components: { FormGroup, InputGroup, InputSelect },
    computed: {
        exchangeState(): ExchangeState {
            let { moedaBase, moedaConversao, valorBase, valorConversao, valorConvertido, moedas } = this.$store.state.exchange
            return { moedaBase, moedaConversao, valorBase, valorConversao, valorConvertido, moedas };
        },
        moedasBase(): Array<Coin> {
            return this.exchangeState.moedas;
        },
        moedasConversao(): Array<Coin> {
            return this.moedasBase.filter((coin: Coin) => coin.name !== this.exchangeState.moedaBase);
        },
    },
    data() {
        return {
            moedaBase: {},
            moedaConversao: {},
            valorBase: 0,
        }
    },
    mounted() {
        this.moedaBase = this.getMoedaByName(this.exchangeState.moedaBase)
        this.moedaConversao = this.exchangeState.moedaConversao
        this.valorBase = this.exchangeState.valorBase
    },
    methods: {
        // -- Gets --
        getMoedaByName(name: String): Coin {
            return this.moedasBase.filter((moeda: Coin) => moeda.name === name)[0]
        },
        getMoedaConversao(): Coin {
            let moedas = this.moedasConversao
                .filter((coin: Coin) => coin.name === this.moedaConversao);
            return moedas[0];
        },
        getMoedaValorConversao(): Number {
             let moedaPrecos = this.moedaBase.coin_prices
                .filter((moedaPreco: CoinPrice) => moedaPreco.coin_convert.name === this.moedaConversao);

            if (!moedaPrecos.length) return 0;

            return Number(moedaPrecos[0].value);
        },
        // -- Sets --
        setLocalMoedaBase(moeda: String): void {
            this.moedaBase = this.getMoedaByName(moeda)
            this.setMoedaBase(moeda)
            this.setLocalMoedaConversao()
        },
        setMoedaBase(moeda: String): void {
            this.$store.commit('exchange/setMoedaBase', moeda)
        },
        setLocalMoedaConversao(moeda?: String): void {
            moeda = moeda ? moeda : ''
            this.moedaConversao = moeda
            this.setMoedaConversao(moeda)
            this.setValorConversao()
        },
        setMoedaConversao(moeda?: String): void {
            this.$store.commit('exchange/setMoedaConversao', moeda)
        },
        setValorBase(valor: Number): void {
            this.$store.commit('exchange/setValorBase', valor)
            this.setValorConversao()
        },
        async setValorConversao(): Promise<void> {
            let valor: Number = this.getMoedaValorConversao()
            await this.$store.commit('exchange/setValorConversao', valor)
            this.setValorConvertido((valor * this.valorBase))
        },
        setValorConvertido(valor: Number): void {
            this.$store.commit('exchange/setValorConvertido', valor)
        }
    }
})
</script>

<style scoped>
.group-inputs { @apply md:w-1/3; }

.group-input-money { @apply flex space-x-2 items-center; }
input { @apply rounded text-sm w-full; }
</style>
