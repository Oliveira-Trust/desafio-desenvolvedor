import type { IUseCase } from '@/core/types/usecase.interface';
import type { IExchangeFeeConfiguration } from '@/domain/entities/exchange-fee-configuration.model';
import {
    exchangeFeeConfigurationRepository,
    type IExchangeFeeConfigurationRepository,
} from '@/repositories/exchange-fee-configuration.repository';
import type { IExchangeFeeConfigurationDTO } from '../dtos/exchange-fee-configuration.dto';

class SaveExchangeFeeConfigurationUseCase implements IUseCase<IExchangeFeeConfiguration, Promise<void>> {
    constructor(private repository: IExchangeFeeConfigurationRepository) {}

    public async execute(config: IExchangeFeeConfiguration): Promise<void> {
        const requestParams: IExchangeFeeConfigurationDTO = {
            amount_threshold: config.amount,
            greater_than_threshold: config.gtThreshold,
            lower_than_threshold: config.ltThreshold,
            effective_date: config.effectiveDate.toISOString(),
        };

        await this.repository.saveConfiguration(requestParams);
    }
}

const saveExchangeFeeConfigurationUseCase = new SaveExchangeFeeConfigurationUseCase(exchangeFeeConfigurationRepository);
export { saveExchangeFeeConfigurationUseCase };
