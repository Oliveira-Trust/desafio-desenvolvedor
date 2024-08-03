import type { IExchangeFeeConfigurationDTO } from "../dtos/exchange-fee-configuration.dto";

export interface IExchangeFeeConfiguration {
    amount: number,
    ltThreshold: number,
    gtThreshold: number,
    effectiveDate: Date
}

export class ExchangeFeeConfiguration implements IExchangeFeeConfiguration {
    constructor(
        public amount: number,
        public ltThreshold: number,
        public gtThreshold: number,
        public effectiveDate: Date
    ) {
    }

    public static fromDTO(dto: IExchangeFeeConfigurationDTO): ExchangeFeeConfiguration {
        return new ExchangeFeeConfiguration(
            dto.amount_threshold,
            dto.lower_than_threshold,
            dto.greater_than_threshold,
            new Date(dto.effective_date)
        )
    }

    public static fromRaw(c: IExchangeFeeConfiguration): ExchangeFeeConfiguration {
        return new ExchangeFeeConfiguration(
            c.amount as number,
            c.ltThreshold as number,
            c.gtThreshold as number,
            new Date(c.effectiveDate as Date)
        );
    }
}
