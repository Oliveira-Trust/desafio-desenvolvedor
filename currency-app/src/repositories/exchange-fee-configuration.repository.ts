import type {AxiosInstance} from "axios";
import axiosInstance from "@/infrastructure/http/axios-config";
import type { IExchangeFeeConfigurationDTO } from "@/domain/dtos/exchange-fee-configuration.dto";

interface IExchangeFeeConfigurationRepository {
    getConfiguration(): Promise<IExchangeFeeConfigurationDTO>;
    saveConfiguration(config: IExchangeFeeConfigurationDTO): Promise<void>;
}

class ExchangeFeeConfigurationRepository implements IExchangeFeeConfigurationRepository {
    constructor(private axios: AxiosInstance) { }

    public async getConfiguration(): Promise<IExchangeFeeConfigurationDTO> {
        return (await this.axios.get('/api/configuration')).data;
    }


    public async saveConfiguration(config: IExchangeFeeConfigurationDTO): Promise<void> {
        return (await this.axios.post('/api/configuration', config)).data.data;
    }
}

const exchangeFeeConfigurationRepository = new ExchangeFeeConfigurationRepository(axiosInstance);
export {exchangeFeeConfigurationRepository, type IExchangeFeeConfigurationRepository};
