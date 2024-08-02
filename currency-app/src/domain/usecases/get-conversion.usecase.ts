import type { IUseCase } from '@/core/types/usecase.interface';
import type { Conversion } from '@/domain/entities/conversion.model';
import { conversionRepository, type IConversionRepository } from '@/repositories/conversion.repository';

class GetConversionUseCase implements IUseCase<number, Promise<Conversion>> {
    constructor(private repository: IConversionRepository) {}

    public async execute(id: number): Promise<Conversion> {
        return await this.repository.getConversion(id);
    }
}

const getConversionUseCase = new GetConversionUseCase(conversionRepository);
export { getConversionUseCase };
