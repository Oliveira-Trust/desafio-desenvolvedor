import type { IUseCase } from '@/core/types/usecase.interface';
import { Exchange } from '@/domain/entities/exchange.model';
import { exchangeRepository, type IExchangeRepository } from '@/repositories/exchange.repository';

class GetExchangesUseCase implements IUseCase<void, Promise<Exchange[]>> {
    constructor(private repository: IExchangeRepository) {}

    public async execute(): Promise<Exchange[]> {
        const data = await this.repository.getExchanges();
        return data.map(dto => Exchange.fromDTO(dto));
    }
}

const getExchangesUseCase = new GetExchangesUseCase(exchangeRepository);
export { getExchangesUseCase };
