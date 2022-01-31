import PaymentMethod from "~/types/PaymentMethod";
import PaymentMethodsState from "~/types/PaymentMethodsState";

export const state = () => new PaymentMethodsState();

export const mutations = {
    setMetodosPagamento(state: PaymentMethodsState, metodosPagamento: Array<PaymentMethod>): void {
        state.metodosPagamento = metodosPagamento
    }
}
