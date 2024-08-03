export interface IExchangeFeeConfigurationDTO {
    amount_threshold: number,
    lower_than_threshold: number,
    greater_than_threshold: number,
    effective_date: string,
}