import Vue from 'vue'
import axios from 'axios'
import apiConfig from '@/services/api/apiConfig.js'
import { useAuthStore } from '@/stores/auth.js'

export const api = axios.create({
    baseURL: apiConfig.baseUrl,
});

api.interceptors.request.use(config => {
        const accessToken = useAuthStore().token

        if (accessToken) {
            config.headers.Authorization = `${apiConfig.tokenType} ${accessToken}`
        }

        return config
    },
    error => Promise.reject(error),
)

Vue.prototype.$api = api;
