import { api } from '@/services/api/index.js'

export const currencyApi =  {
    index: async (parameters) => {
        const { data } = await api.get('currency', parameters)
        return data
    },
}
