import type { IUseCase } from '@/core/types/usecase.interface';
import {Currency} from "@/domain/entities/currency.model";
import { exchangeRepository, type IExchangeRepository } from '@/repositories/exchange.repository';

class GetAvailableCoinsUsecase implements IUseCase<void, Promise<Currency[]>> {
    constructor(private repository: IExchangeRepository) {}

    public async execute(): Promise<Currency[]> {
        const data = await this.repository.getAvailableCoins();
        return data.map(dto => Currency.fromDTO(dto));
    }
}

const getAvailableCoinsUsecase = new GetAvailableCoinsUsecase(exchangeRepository);
export { getAvailableCoinsUsecase };
