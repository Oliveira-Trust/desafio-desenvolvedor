import axios from 'axios'
import { getLocalStorage } from './functions';

const api = axios.create({
    baseURL: "http://localhost:8080/"
});

export const getCurrencies = async () => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.get('moedas', {"headers": headers})
    if (response.status === 200) {
        return response.data.data
    }
}
export const getPaymentForms = async () => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.get('payments', {"headers": headers})
    return response.data
}
export const sendConversion = async (data) => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.post(`conversion`, data, {"headers": headers})
    return response.data
}
export const sendLogin = async (data) => {
    const response = await api.post(`singin`, data)
    return response.data
}
export const getTransactions = async (userid) => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.get(`transactions/${userid}`, {"headers": headers})
    if (response.data.status === "error") return
    const { user } = response.data.data
    return user.transactions
}
export const saveTaxTransactions = async (values) => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.post(`taxtransaction`, values, {"headers": headers})
    return response.data
}
export const getTaxTransactions = async () => {
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': getLocalStorage().token
    }
    const response = await api.get(`taxtransaction`, {"headers": headers})
    if (response.data.status === "error") return
    return response.data
}
export const saveUser = async (data) => {
    const response = await api.post(`singup`, data)
    return response.data
}
export default api