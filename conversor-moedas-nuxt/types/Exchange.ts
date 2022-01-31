import ExchangeContract from '~/interfaces/Exchange'
import Conversion from './Conversion';
import PaymentMethod from './PaymentMethod';

export default class Exchange implements ExchangeContract
{
    id: Number;
    conversion_id: Number;
    user_id: Number;
    payment_method_id: Number;

    payment_price: Number;
    conversion_price: Number;
    conversior_tax: Number;
    price: Number;
    value: Number;

    conversion?: Conversion;
    payment_method?: PaymentMethod

    constructor(
        id: Number = 0,
        conversion_id: Number = 0,
        user_id: Number = 0,
        payment_method_id: Number = 0,
        payment_price: Number = 0,
        conversion_price: Number = 0,
        conversior_tax: Number = 0,
        price: Number = 0,
        value: Number = 0
    ) {
        this.id = id;
        this.conversion_id = conversion_id;
        this.user_id = user_id;
        this.payment_method_id = payment_method_id;

        this.payment_price = payment_price;
        this.conversion_price = conversion_price;
        this.conversior_tax = conversior_tax;
        this.price = price;
        this.value = value;
    }

    get payment_price_locale(): String { return this.payment_price.toLocaleString(); }
    get conversion_price_locale(): String { return this.conversion_price.toLocaleString(); }
    get conversior_tax_locale(): String { return this.conversior_tax.toLocaleString(); }
    get price_locale(): String { return this.price.toLocaleString(); }
    get value_locale(): String { return this.value.toLocaleString(); }
}
