import CoinPrice from "~/types/CoinPrice";
import Exchange from "~/types/Exchange";

export default interface Conversion
{
    id: Number;
    coin_price_id: Number;
    value: Number;

    coin_price?: CoinPrice;
    exchange?: Exchange;
}
