import { loginUseCase } from '@/domain/usecases/login.usecase';
import { logoutUseCase } from '@/domain/usecases/logout.usecase';
import { defineStore } from 'pinia';
import { getUserAuthenticatedUsecase } from '@/domain/usecases/get-user-authenticated.usecase';

interface AuthState {
    isLoggedIn: boolean;
    name: string;
    email: string;
    checkingAuthentication: boolean;
}

export const useAuthStore = defineStore('auth', {
    state: () =>
        ({
            name: '',
            email: '',
            isLoggedIn: false,
            checkingAuthentication: false,
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
            try {
                this.checkingAuthentication = true;
                
                if (document.cookie.includes('XSRF-TOKEN')) {
                    const user = await getUserAuthenticatedUsecase.execute();
                    this.name = user.name
                    this.email = user.email
                    this.isLoggedIn = true;
                }
            } catch (error: unknown) {
                //
            } finally {
                this.checkingAuthentication = false;
            }
            
            return false;
        },
    },
});
