import { Conversion } from '../domain/entities/conversion.model';

interface IConversionRepository {
    getConversions(): Promise<Conversion[]>;
    getConversion(id: number): Promise<Conversion>;
    store(conversion: Conversion): Promise<string>;
}

/**
 * Classe responsável por transformar dados e se comunicar com o serviço de websocket.
 */
class ConversionRepository implements IConversionRepository {
    public async getConversions(): Promise<Conversion[]> {
        return new Promise((resolve, reject) => {
            reject(new Error(`[ConversionRepository.getConversions()]: Method not implemented yet.`));
        });
    }

    public async getConversion(id: number): Promise<Conversion> {
        return new Promise((resolve, reject) => {
            reject(new Error(`[ConversionRepository.getConversion()]: Method not implemented yet.`));
        });
    }

    public async store(conversion: Conversion): Promise<string> {
        return new Promise((resolve, reject) => {
            reject(new Error(`[ConversionRepository.store()]: Method not implemented yet.`));
        });
    }
}

const conversionRepository = new ConversionRepository();
export { conversionRepository, type IConversionRepository };
