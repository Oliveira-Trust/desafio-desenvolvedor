import type { IUseCase } from '@/core/types/usecase.interface';
import { exchangeRepository, type IExchangeRepository } from '@/repositories/exchange.repository';
import { Exchange, type ICreateExchange } from '../entities/exchange.model';

class CreateExchangeUseCase implements IUseCase<ICreateExchange, Promise<Exchange>> {
    constructor(private repository: IExchangeRepository) {}

    public async execute(form: ICreateExchange): Promise<Exchange> {
        if (form.sourceCurrency === form.destinationCurrency) {
            throw new Error('A moeda de destino deve ser diferente da moeda de origem.');
        }

        if (form.originalAmount < 1000 || form.originalAmount > 100000) {
            throw new Error('O valor para conversão deve estar entre R$ 1.000,00 e R$ 100.000,00.');
        }

        const data = await this.repository.createExchange({
            source_currency: form.sourceCurrency,
            destination_currency: form.destinationCurrency,
            payment_method: form.paymentMethod,
            original_amount: form.originalAmount,
        });

        return Exchange.fromDTO(data);
    }
}

const createExchangeUseCase = new CreateExchangeUseCase(exchangeRepository);
export { createExchangeUseCase };
