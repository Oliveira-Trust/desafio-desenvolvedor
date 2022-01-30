import Coin from "./Coin";

export default interface CoinPrice {
    id: Number,
    name: String,
    coin_base_id: Number,
    coin_conver_id: Number,
    coin_convert: Coin,
    value: Number
}
