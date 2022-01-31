import Conversion from "~/types/Conversion";
import PaymentMethod from "~/types/PaymentMethod";

export default interface Exchange
{
    id: Number;
    conversion_id: Number;
    user_id: Number;
    payment_method_id: Number;
    price: Number;
    value: Number;

    conversion?: Conversion;
    payment_method?: PaymentMethod
}
