import Coin from "~/interfaces/Coin";

export interface ExchangeState {
    valorBase: Number,
    valorConversao: Number,
    valorConvertido: Number,
    moedaBase: String,
    moedaConversao?: String,
    moedas: Array<Coin>
}

export const state = () => ({
    valorBase: 0,
    valorConversao: 0,
    valorConvertido: 0,
    moedaBase: 'BRL',
    moedaConversao: '',
    moedas: [],
});

export const mutations = {
    setValorBase(state: ExchangeState, valorBase: Number): void {
        state.valorBase = valorBase;
    },
    setValorConversao(state: ExchangeState, valorConversao: Number): void {
        state.valorConversao = valorConversao
    },
    setValorConvertido(state: ExchangeState, valorConvertido: Number): void {
        state.valorConvertido = valorConvertido
    },
    setMoedaBase(state: ExchangeState, moedaBase: String): void {
        state.moedaBase = moedaBase;
    },
    setMoedaConversao(state: ExchangeState, moedaConversao?: String): void {
        state.moedaConversao = moedaConversao;
    },
    setMoedas(state: ExchangeState, moedas: Array<Coin>): void {
        state.moedas = moedas;
    },
}
