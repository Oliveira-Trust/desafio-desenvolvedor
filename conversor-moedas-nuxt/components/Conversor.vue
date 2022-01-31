<template>
    <form-group>
        <input-group class="group-inputs">
            <label for="moeda-base">Moeda base</label>
            <input-select id="moeda-base" :value="exchangeState.moedaBase" @change="setLocalMoedaBase" :canBeEmpty="!Boolean(moedasBase)">
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

import Coin from '~/types/Coin'
import CoinPrice from '~/types/CoinPrice'
import ExchangeState from '~/types/ExchangeState'

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
            if (!Boolean(this.moedasBase)) return [];
            return this.moedasBase.filter((coin: Coin) => coin.name !== this.exchangeState.moedaBase);
        },
    },
    data() {
        let moedaBase: Coin = new Coin(),
            moedaConversao: Coin = new Coin(),
            valorBase: Number = 0;

        return {
            moedaBase,
            moedaConversao,
            valorBase
        }
    },
    mounted() {
        this.moedaBase = this.getMoedaByName(this.exchangeState.moedaBase)
        this.moedaConversao = this.getMoedaByName(this.exchangeState.moedaConversao)
        this.valorBase = this.exchangeState.valorBase
    },
    methods: {
        // -- Gets --
        getMoedaByName(name: String): Coin {
            let moedas:Array<Coin> = this.moedasBase.filter((moeda: Coin) => moeda.name === name)
            if (!Boolean(moedas.length)) return new Coin()

            return moedas[0]
        },
        getMoedaConversao(): Coin {
            let moedas: Array<Coin> = this.moedasConversao
                .filter((coin: Coin) => {coin.name === this.moedaConversao.name});
            return moedas[0];
        },
        getMoedaValorConversao(): Number {
            if (this.moedaBase.coin_prices === undefined) return 0;

            let moedaPrecos: Array<CoinPrice> = this.moedaBase.coin_prices;
            moedaPrecos = moedaPrecos
                .filter((moedaPreco: CoinPrice): Boolean => {
                    if (moedaPreco.coin_convert === undefined) return false;
                    let coinConvert = moedaPreco.coin_convert

                    if (coinConvert.name === undefined) return false;
                    if (coinConvert.name === undefined) return false;
                    return (coinConvert.name === this.moedaConversao.name)
                });

            if (!Boolean(moedaPrecos.length)) return 0;

            let precoMoeda: CoinPrice = moedaPrecos[0];
            return Number(precoMoeda.value);
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
            this.moedaConversao = this.getMoedaByName(moeda)
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
        setValorConversao(): void {
            let valor: Number = this.getMoedaValorConversao()
            this.$store.commit('exchange/setValorConversao', valor)
            this.setValorConvertido((Number(valor) * Number(this.valorBase)))
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
