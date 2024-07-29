import axios from 'axios';

export const getStates = async () => {
    try {
        const response = await axios.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome');
        return response.data;
    } catch (error) {
        console.error(error);
    }
}

export const getCities = async (stateId) => {
    try {
        const response = await axios.get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${stateId}/municipios`);
        return response.data;
    } catch (error) {
        console.error(error);
    }
}
