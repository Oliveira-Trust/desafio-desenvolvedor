import { loginUseCase } from '@/domain/usecases/login.usecase';
import { logoutUseCase } from '@/domain/usecases/logout.usecase';
import { defineStore } from 'pinia';

interface AuthState {
    isLoggedIn: boolean;
    username: string;
}

export const useAuthStore = defineStore('auth', {
    state: () =>
        ({
            isLoggedIn: false,
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
    },
});
