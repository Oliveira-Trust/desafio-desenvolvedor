import type { IUseCase } from '@/core/types/usecase.interface';
import { Conversion, type IConversion } from '@/domain/entities/conversion.model';
import { conversionRepository, type IConversionRepository } from '@/repositories/conversion.repository';

class CreateConversionUseCase implements IUseCase<IConversion, Promise<Conversion>> {
    constructor(private repository: IConversionRepository) {}

    public async execute(conversion: IConversion): Promise<Conversion> {
        throw new Error('[CreateConversionUseCase.execute()]: Method not impplemented yet.');
    }
}

const createConversionUseCase = new CreateConversionUseCase(conversionRepository);
export { createConversionUseCase };
