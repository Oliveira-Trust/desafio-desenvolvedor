import { Conversion } from '@/domain/entities/conversion.model';
import { createConversionUseCase } from '@/domain/usecases/create-conversion.usecase';
import { getConversionUseCase } from '@/domain/usecases/get-conversion.usecase';
import { getConversionsUseCase } from '@/domain/usecases/get-conversions.usecase';
import { defineStore } from 'pinia';

export const useConversionStore = defineStore('conversion', {
    state: () => ({
        conversionsMap: new Map<number, Conversion>(),
    }),
    getters: {
        conversions: (state) => Array.from(state.conversionsMap.values()),
    },
    actions: {
        async fetchConversions() {
            const conversionsFetched = await getConversionsUseCase.execute();
            this.conversionsMap.clear();
            conversionsFetched.forEach((conversion: Conversion) => {
                this.conversionsMap.set(conversion.id, conversion);
            });
        },
        async getConversion(id: number): Promise<Conversion> {
            if (this.conversionsMap.has(id)) {
                return this.conversionsMap.get(id) as Conversion;
            }

            return await getConversionUseCase.execute(id);
        },
        async createConversion(conversion: Conversion) {
            const createdConversion = await createConversionUseCase.execute(conversion);
            this.conversionsMap.set(createdConversion.id, createdConversion);
        },
    },
});
