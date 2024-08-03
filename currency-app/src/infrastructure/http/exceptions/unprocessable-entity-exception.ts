export default class UnprocessableEntityException extends Error {
    public statusCode: number;
    public errors: any;

    constructor(message: string, errors: {[x: string]: string[]} = {}) {
        super(message);
        this.statusCode = 422;
        this.errors = errors;
        this.name = 'UnprocessableEntityException';
    }
}