import type { IUseCase } from '@/core/types/usecase.interface';
import type { Conversion } from '@/domain/entities/conversion.model';
import { conversionRepository, type IConversionRepository } from '@/repositories/conversion.repository';

class GetConversionsUseCase implements IUseCase<void, Promise<Conversion[]>> {
    constructor(private repository: IConversionRepository) {}

    public async execute(): Promise<Conversion[]> {
        return this.repository.getConversions();
    }
}

const getConversionsUseCase = new GetConversionsUseCase(conversionRepository);
export { getConversionsUseCase };
