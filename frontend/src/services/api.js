import axios from 'axios'

const api = axios.create({
    baseURL: process.env.REACT_APP_API
});

export const getCurrencies = async () => {
    return await api.get('moedas')    
}