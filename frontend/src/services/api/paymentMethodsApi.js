import { api } from '@/services/api/index.js'

export const paymentMethodsApi =  {
    index: async (parameters) => {
        const { data } = await api.get('payment_method', parameters)
        return data
    },

    update: async (id, parameters) => {
        const { data } = await api.put('payment_method/' + id, parameters)
        return data
    },
}
