import type { ICurrencyDTO } from "../dtos/currency.dto";

export interface ICurrency {
    code: string;
    name: string;
}

export class Currency implements ICurrency {
    constructor(
        public code: string,
        public name: string,
    ) {
    }

    public static fromDTO(dto: ICurrencyDTO): Currency {
        return new Currency(
            dto.code,
            dto.name,
        )
    }
}
