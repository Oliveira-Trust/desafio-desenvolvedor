import CoinContract from '~/interfaces/Coin'
import CoinPrice from './CoinPrice';

export default class Coin implements CoinContract
{
    id: Number;
    name: String;
    coin_prices?: Array<Coin>;
    coin_convert?: CoinPrice;

    constructor(id: Number = 0, name: String = '') {
        this.id = id;
        this.name = name;
    }
}
