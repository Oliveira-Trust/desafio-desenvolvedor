import {defineStore} from 'pinia';
import {getAvailableCoinsUsecase} from "@/domain/usecases/get-available-currencies.usecase";
import type {Currency} from "@/domain/entities/currency.model";
import type { Exchange, ICreateExchange } from '@/domain/entities/exchange.model';
import { getExchangesUseCase } from '@/domain/usecases/get-exchanges.usecase';
import { createExchangeUseCase } from '@/domain/usecases/create-exchange.usecase';

export const useExchangeStore = defineStore('exchanges', {
    state: () => ({
        exchangesMap: new Map<number, Exchange>(),
        currencies: [] as Currency[]
    }),
    getters: {
        exchanges: (state) => Array.from(state.exchangesMap.values()).sort((a, b) => b.createdAt.getTime() - a.createdAt.getTime()),
    },
    actions: {
        async fetchExchanges() {
            const exchangesFetched = await getExchangesUseCase.execute();
            this.exchangesMap.clear();
            exchangesFetched.forEach((exchange: Exchange) => {
                this.exchangesMap.set(exchange.id, exchange);
            });
        },
        async fetchCoins() {
            this.currencies = await getAvailableCoinsUsecase.execute();
        },
        async createExchange(exchange: ICreateExchange) {
            const createdExchange = await createExchangeUseCase.execute(exchange);
            this.exchangesMap.set(createdExchange.id, createdExchange);
        },
    },
});
