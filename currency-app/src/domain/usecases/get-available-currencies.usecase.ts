import type { IUseCase } from '@/core/types/usecase.interface';
import { Currency } from '@/domain/entities/currency.model';
import { exchangeRepository, type IExchangeRepository } from '@/repositories/exchange.repository';

class GetAvailableCurrenciesUsecase implements IUseCase<void, Promise<Currency[]>> {
    constructor(private repository: IExchangeRepository) {}

    public async execute(): Promise<Currency[]> {
        const data = await this.repository.getAvailableCurrencies();
        return data.map((dto) => Currency.fromDTO(dto));
    }
}

const getAvailableCurrenciesUsecase = new GetAvailableCurrenciesUsecase(exchangeRepository);
export { getAvailableCurrenciesUsecase };
