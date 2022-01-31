import ExchangeContract from '~/interfaces/Exchange'
import Conversion from './Conversion';
import PaymentMethod from './PaymentMethod';

export default class Exchange implements ExchangeContract
{
    id: Number;
    conversion_id: Number;
    user_id: Number;
    payment_method_id: Number;
    price: Number;
    value: Number;

    conversion?: Conversion;
    payment_method?: PaymentMethod

    constructor(
        id: Number = 0,
        conversion_id: Number = 0,
        user_id: Number = 0,
        payment_method_id: Number = 0,
        price: Number = 0,
        value: Number = 0
    ) {
        this.id = id;
        this.conversion_id = conversion_id;
        this.user_id = user_id;
        this.payment_method_id = payment_method_id;
        this.price = price;
        this.value = value;
    }
}
