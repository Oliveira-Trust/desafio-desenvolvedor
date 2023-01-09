import { useAuthStore } from '@/stores/auth.js'

export const isUserLoggedIn = () => {
    return !!useAuthStore().accessToken;
}
