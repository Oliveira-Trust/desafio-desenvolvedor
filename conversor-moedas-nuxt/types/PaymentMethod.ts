import PaymentMethodContract from '~/interfaces/PaymentMethod'

export default class PaymentMethod implements PaymentMethodContract
{
    id: Number;
    name: String;
    tax: Number;

    constructor(id: Number = 0, name: String = '', tax: Number = 0)
    {
        this.id = id;
        this.name = name;
        this.tax = tax;
    }

    get tax_locale(): String { return this.tax.toLocaleString() }
}
