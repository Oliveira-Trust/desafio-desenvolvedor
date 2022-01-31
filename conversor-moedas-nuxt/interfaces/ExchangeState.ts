import Coin from "~/types/Coin";

export default interface ExchangeState {
    valorBase: Number;
    valorConversao: Number;
    valorConvertido: Number;
    moedaBase: String;
    moedaConversao: String;
    moedas: Array<Coin>
}
