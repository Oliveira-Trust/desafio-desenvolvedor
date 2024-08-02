import type { IUseCase } from '@/core/types/usecase.interface';
import { authRepository, type IAuthRepository } from '../../repositories/auth.repository';

interface LoginParams {
    username: string;
    password: string;
}

class LoginUseCase implements IUseCase<LoginParams, Promise<void>> {
    constructor(private repository: IAuthRepository) {}

    public async execute(params: LoginParams): Promise<void> {
        return await this.repository.login(params.username, params.password);
    }
}

const loginUseCase = new LoginUseCase(authRepository);
export { loginUseCase };
