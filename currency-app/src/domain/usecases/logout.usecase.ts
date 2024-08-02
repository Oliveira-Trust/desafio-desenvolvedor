import type { IUseCase } from '@/core/types/usecase.interface';
import { authRepository, type IAuthRepository } from '../../repositories/auth.repository';

class LogoutUseCase implements IUseCase<void, Promise<void>> {
    constructor(private repository: IAuthRepository) {}

    public async execute() {
        await this.repository.logout();
    }
}

const logoutUseCase = new LogoutUseCase(authRepository);
export { logoutUseCase };
