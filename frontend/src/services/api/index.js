import Vue from 'vue'
import axios from 'axios'
import apiConfig from '@/services/api/apiConfig.js'
import { useAuthStore } from '@/stores/auth.js'

export const api = axios.create({
    baseURL: apiConfig.baseUrl,
})

api.interceptors.request.use(config => {
        const accessToken = useAuthStore().accessToken

        if (accessToken) {
            config.headers.Authorization = `${apiConfig.tokenType} ${accessToken}`
        }

        return config
    },
    error => Promise.reject(error),
)


export const login = async (parameters) => {
    const { data } = await api.post('login',  parameters )
    return data
}

export const fees = async (parameters) => {
    const { data } = await api.get('fee',  parameters )
    return data
}

export const feeUpdate = async (id,parameters) => {
    const { data } = await api.put('fee/'+id,  parameters )
    return data
}

Vue.prototype.$api = api
