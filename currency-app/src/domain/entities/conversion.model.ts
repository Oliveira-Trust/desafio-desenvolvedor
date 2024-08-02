export interface IConversion {
    id?: number;
}

export class Conversion implements IConversion {
    constructor(public id: number) {}
}
