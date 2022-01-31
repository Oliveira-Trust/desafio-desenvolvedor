import CoinPriceContract from '~/interfaces/CoinPrice'
import Coin from './Coin'

export default class CoinPrice implements CoinPriceContract
{
    id: Number;
    name: String;
    coin_base_id?: Number;
    coin_conver_id?: Number;
    coin_base?: Coin;
    coin_convert?: Coin;
    value: Number;

    constructor(id: Number = 0, name: String = '', value: Number = 0) {
        this.id = id;
        this.name = name;
        this.value = value;
    }

    get value_locale(): String { return this.value.toLocaleString(); }
}
