import type { AxiosInstance } from 'axios';
import axiosInstance from '@/infrastructure/http/axios-config';
import type { ICurrencyDTO } from '@/domain/dtos/currency.dto';
import type { ICreateExchangeRequestDTO, IExchangeDTO } from '@/domain/dtos/exchange.dto';

interface IExchangeRepository {
    getExchanges(): Promise<IExchangeDTO[]>;
    getAvailableCoins(): Promise<ICurrencyDTO[]>;
    createExchange(exchange: ICreateExchangeRequestDTO): Promise<IExchangeDTO>;
}

class ExchangeRepository implements IExchangeRepository {
    constructor(private axios: AxiosInstance) {}

    public async getExchanges(): Promise<IExchangeDTO[]> {
        return (await this.axios.get('/api/history')).data.data;
    }

    public async getAvailableCoins(): Promise<ICurrencyDTO[]> {
        return (await this.axios.get('/api/available-coins')).data;
    }

    public async createExchange(exchange: ICreateExchangeRequestDTO): Promise<IExchangeDTO> {
        return (await this.axios.post('/api/convert', exchange)).data.data;
    }
}

const exchangeRepository = new ExchangeRepository(axiosInstance);
export { exchangeRepository, type IExchangeRepository as IExchangeRepository };
