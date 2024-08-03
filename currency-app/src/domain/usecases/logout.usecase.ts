import type { IUseCase } from '@/core/types/usecase.interface';
import { authRepository, type IAuthRepository } from '../../repositories/auth.repository';

class LogoutUseCase implements IUseCase<void, Promise<void>> {
    constructor(private repository: IAuthRepository) {}

    private deleteCookie(name: string): void {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/`;
    }

    public async execute() {
        await this.repository.logout();
        this.deleteCookie('XSRF-TOKEN')
        this.deleteCookie('laravel_session')
    }
}

const logoutUseCase = new LogoutUseCase(authRepository);
export { logoutUseCase };
