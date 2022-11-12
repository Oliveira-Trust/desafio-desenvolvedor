import axios from "axios";

export const api = axios.create({
    baseURL: "http://localhost:8000/api/"
});

export const getApiCurrencies = async () => {
    const { data } = await api.get('currencies')
    return data;
}

export const getApiExchange = async (params) => {
    const { data } = await api.get('exchange', { params } )
    return data
}