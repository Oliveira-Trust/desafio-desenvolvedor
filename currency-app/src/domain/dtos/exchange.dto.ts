export interface IExchangeDTO {
    id: number,
    user_id: number,
    source_currency: string,
    destination_currency: string,
    original_amount: number,
    payment_method: string,
    amount_in_destination_currency: number,
    payment_method_fee: number,
    conversion_fee: number,
    total_with_fees: number,
    created_at: string,
    updated_at: string
}

export type ICreateExchangeRequestDTO = {
    source_currency: string,
    destination_currency: string,
    original_amount: number,
    payment_method: string
}