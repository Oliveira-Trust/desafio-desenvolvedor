import axios from "axios";

export const api = axios.create({
    baseURL: "http://localhost/api/"
});

export const getApiCurrencies = async () => {
    const { data } = await api.get('currencies')
    return data;
}

export const getApiExchange = async (params) => {
    console.log(params)
    const { data } = await api.get('converter', { params } )
    return data
}