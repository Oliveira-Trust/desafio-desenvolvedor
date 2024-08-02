interface IAuthRepository {
    login(username: string, password: string): Promise<void>;
    logout(): Promise<void>;
}

/**
 * Classe responsável por transformar dados e se comunicar com o serviço de websocket.
 */
class AuthRepository implements IAuthRepository {
    public async login(username: string, password: string): Promise<void> {
        return new Promise((resolve, reject) => {
            if (!(username === 'david' && password === '123456')) {
                reject(
                    // new Error(
                    //     `[AuthRepository.login()]: Method not implemented yet - username: '${username}' password: '${password}'.`,
                    // ),
                    new Error('Houve um erro ao realizar login'),
                );
            }

            resolve();
        });
    }

    public async logout(): Promise<void> {
        return new Promise<void>((resolve, reject) => {
            reject(new Error(`[AuthRepository.logout()]: Method not implemented yet.`));
        });
    }
}

const authRepository = new AuthRepository();
export { authRepository, type IAuthRepository };
