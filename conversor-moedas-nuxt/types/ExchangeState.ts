import ExchangeStateContract from '~/interfaces/ExchangeState'
import Coin from './Coin';

export default class ExchangeState implements ExchangeStateContract
{
    valorBase: Number;
    valorConversao: Number;
    valorConvertido: Number;
    moedaBase: String;
    moedaConversao: String;
    moedas: Array<Coin>

    constructor() {
        this.valorBase = 0;
        this.valorConversao = 0;
        this.valorConvertido = 0;
        this.moedaBase = '';
        this.moedaConversao = '';
        this.moedas = [];
    }
}
