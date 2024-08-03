import type { IUseCase } from '@/core/types/usecase.interface';
import {
    exchangeFeeConfigurationRepository,
    type IExchangeFeeConfigurationRepository,
} from '@/repositories/exchange-fee-configuration.repository';
import { ExchangeFeeConfiguration } from '@/domain/entities/exchange-fee-configuration.model';

class GetExchangeFeeConfigurationUseCase implements IUseCase<void, Promise<ExchangeFeeConfiguration>> {
    constructor(private repository: IExchangeFeeConfigurationRepository) {}

    public async execute(): Promise<ExchangeFeeConfiguration> {
        const data = await this.repository.getConfiguration();
        return ExchangeFeeConfiguration.fromDTO(data);
    }
}

const getExchangeFeeConfigurationUseCase = new GetExchangeFeeConfigurationUseCase(exchangeFeeConfigurationRepository);
export { getExchangeFeeConfigurationUseCase };
