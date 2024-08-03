import type { IExchangeDTO } from "../dtos/exchange.dto";

export interface IExchange {
    sourceCurrency: string;
    destinationCurrency: string;
    originalAmount: number;
    paymentMethod: string;
    amountInDestinationCurrency: number;
    paymentFee: number;
    conversionFee: number;
    totalWithFees: number;
    createdAt: Date;
    id?: number;
}

export type ICreateExchange = Pick<IExchange, 'sourceCurrency' | 'destinationCurrency' | 'originalAmount' | 'paymentMethod'>;

export class Exchange implements IExchange {
    constructor(
        public id: number,
        public sourceCurrency: string,
        public destinationCurrency: string,
        public originalAmount: number,
        public paymentMethod: string,
        public amountInDestinationCurrency: number,
        public paymentFee: number,
        public conversionFee: number,
        public totalWithFees: number,
        public createdAt: Date,
    ) {
    }

    public static fromDTO(dto: IExchangeDTO): Exchange {
        return new Exchange(
            dto.id,
            dto.source_currency,
            dto.destination_currency,
            dto.original_amount,
            dto.payment_method,
            dto.amount_in_destination_currency,
            dto.payment_method_fee,
            dto.conversion_fee,
            dto.total_with_fees,
            new Date(dto.created_at)
        )
    }

    public static fromRaw(c: IExchange): Exchange {
        return new Exchange(
            c.id as number,
            c.sourceCurrency as string,
            c.destinationCurrency  as string,
            c.originalAmount  as number,
            c.paymentMethod  as string,
            c.amountInDestinationCurrency as number,
            c.paymentFee as number,
            c.conversionFee as number,
            c.totalWithFees as number,
            new Date(c.createdAt as Date)
        )
    }
}
