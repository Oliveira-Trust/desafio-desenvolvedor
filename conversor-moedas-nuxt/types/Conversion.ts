import ConversionContract from '~/interfaces/Conversion'
import CoinPrice from './CoinPrice';
import Exchange from './Exchange';

export default class Conversion implements ConversionContract
{
    id: Number;
    coin_price_id: Number;
    value: Number;

    coin_price?: CoinPrice;
    exchange?: Exchange;

    constructor(id: Number = 0, coin_price_id: Number = 0, value: Number = 0)
    {
        this.id = id;
        this.coin_price_id = 0;
        this.value = 0;
    }

    get value_locale(): String { return this.value.toLocaleString(); }
}
