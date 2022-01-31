import PaymentMethodsStateContract from '~/interfaces/PaymentMethodsState'
import PaymentMethod from './PaymentMethod'

export default class PaymentMethodsState implements PaymentMethodsStateContract
{
    metodosPagamento: Array<PaymentMethod>

    constructor() { this.metodosPagamento = [] }
}
