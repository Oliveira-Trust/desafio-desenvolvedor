import { api } from '@/services/api/index.js'

export const feeApi =  {
    index: async (parameters) => {
        const { data } = await api.get('fee', parameters)
        return data
    },

    update: async (id, parameters) => {
        const { data } = await api.put('fee/' + id, parameters)
        return data
    },

    create: async (parameters) => {
        const { data } = await api.post('fee', parameters)
        return data
    },

    destroy: async (id, parameters) => {
        const { data } = await api.delete('fee/' + id, parameters)
        return data
    },
}
