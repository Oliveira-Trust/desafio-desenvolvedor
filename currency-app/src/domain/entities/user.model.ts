interface IUser {
    id: string;
    name: string;
    email: string;
    password?: string;
}

export class User implements IUser {
    constructor(
        public id: string,
        public name: string,
        public email: string,
        public password?: string,
    ) {}
}
