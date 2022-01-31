import CoinPrice from "./CoinPrice";

export default interface Coin {
    id: Number;
    name: String;
    coin_prices?: Array<CoinPrice>;
    coin_convert?: CoinPrice;
}
