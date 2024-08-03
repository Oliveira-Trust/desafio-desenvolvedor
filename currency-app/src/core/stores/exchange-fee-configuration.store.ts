import {defineStore} from 'pinia';
import {ExchangeFeeConfiguration, type IExchangeFeeConfiguration} from "@/domain/entities/exchange-fee-configuration.model";
import { getExchangeFeeConfigurationUseCase } from '@/domain/usecases/get-exchange-fee-configuration.usecase';
import { saveExchangeFeeConfigurationUseCase } from '@/domain/usecases/save-exchange-fee-configuration.usecase';

interface IExchangeFeeConfigurationStore {
    feeConfiguration: ExchangeFeeConfiguration | null
}

export const useExchangeFeeConfigurationStore = defineStore('exchange-fee-configuration', {
    state: () => ({
        feeConfiguration: null
    } as IExchangeFeeConfigurationStore),
    getters: {},
    actions: {
        async fetchConfiguration() {
            this.feeConfiguration = await getExchangeFeeConfigurationUseCase.execute();
        },
        async saveConfiguration(configuration: IExchangeFeeConfiguration) {
            await saveExchangeFeeConfigurationUseCase.execute(configuration);
            this.feeConfiguration = ExchangeFeeConfiguration.fromRaw(configuration);
        },
    },
});
