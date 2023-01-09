import { api } from '@/services/api/index.js'

export const exchangeApi =  {
    index: async (parameters) => {
        const { data } = await api.get('exchange', parameters)
        return data
    },
    create: async (parameters) => {
        const { data } = await api.post('exchange', parameters)
        return data
    },
}
