import type {AxiosInstance} from "axios";
import axiosInstance from "@/infrastructure/http/axios-config";
import type { IUserDTO } from "@/domain/dtos/user.dto";

interface IAuthRepository {
    login(username: string, password: string): Promise<void>;
    logout(): Promise<void>;
    getUserAuthenticated(): Promise<IUserDTO>;
}

class AuthRepository implements IAuthRepository {
    constructor(private axios: AxiosInstance) { }

    public async login(email: string, password: string): Promise<void> {
        await this.axios.post('/login', { email, password });
    }

    public async logout(): Promise<void> {
        await this.axios.post('/logout');
    }

    public async getUserAuthenticated(): Promise<IUserDTO> {
        return (await this.axios.get<IUserDTO>('/api/user')).data;
    }
}

const authRepository = new AuthRepository(axiosInstance);
export { authRepository, type IAuthRepository };
