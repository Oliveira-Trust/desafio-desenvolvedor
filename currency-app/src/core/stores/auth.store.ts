import { loginUseCase } from '@/domain/usecases/login.usecase';
import { logoutUseCase } from '@/domain/usecases/logout.usecase';
import { defineStore } from 'pinia';
import { getUserAuthenticatedUsecase } from '@/domain/usecases/get-user-authenticated.usecase';

interface AuthState {
    isLoggedIn: boolean;
    name: string;
    email: string;
}

export const useAuthStore = defineStore('auth', {
    state: () =>
        ({
            name: '',
            email: '',
            isLoggedIn: document.cookie.includes('XSRF-TOKEN'),
        }) as AuthState,
    getters: {},
    actions: {
        async login(username: string, password: string): Promise<void> {
            await loginUseCase.execute({ username, password });
            this.isLoggedIn = true;
        },
        async logout() {
            await logoutUseCase.execute();
            window.document.location.reload();
        },
        async checkUserAuthenticated() {
            const user = await getUserAuthenticatedUsecase.execute();
        },
    },
});
