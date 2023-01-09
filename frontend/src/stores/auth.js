import { defineStore } from 'pinia'
import { useStorage } from '@vueuse/core'
import apiConfig from '@/services/api/apiConfig.js'

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    accessToken: useStorage(apiConfig.localStorageAccessTokenKey, '')
  }),
  actions: {
    setAccessToken(token) {
      this.accessToken = token
    }
  }
})
