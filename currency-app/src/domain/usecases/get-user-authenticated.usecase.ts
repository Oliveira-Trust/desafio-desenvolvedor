import type { IUseCase } from '@/core/types/usecase.interface';
import { authRepository, type IAuthRepository } from '@/repositories/auth.repository';
import { User } from '@/domain/entities/user.model';

class GetUserAuthenticatedUsecase implements IUseCase<void, Promise<User>> {
    constructor(private repository: IAuthRepository) {}

    public async execute() {
        const dto = await this.repository.getUserAuthenticated();
        return User.fromDTO(dto);
    }
}

const getUserAuthenticatedUsecase = new GetUserAuthenticatedUsecase(authRepository);
export { getUserAuthenticatedUsecase };
