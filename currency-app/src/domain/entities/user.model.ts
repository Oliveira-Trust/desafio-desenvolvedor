import type { IUserDTO } from "../dtos/user.dto";

interface IUser {
    id: number;
    name: string;
    email: string;
}

export class User implements IUser {
    constructor(
        public id: number,
        public name: string,
        public email: string,
    ) {}

    public static fromDTO(dto: IUserDTO): User {
        return new User(
            dto.id,
            dto.name,
            dto.email,
        )
    }
}
