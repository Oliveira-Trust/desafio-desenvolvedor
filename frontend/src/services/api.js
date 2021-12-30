import axios from 'axios'
import { getLocalStorage } from './functions';

const api = axios.create({
    baseURL: "http://localhost:8080/"
});

export const getCurrencies = async () => {
    const response = await api.get('moedas')
    if (response.status === 200) {
        return response.data.data
    }
}
export const getPaymentForms = async () => {
    const response = await api.get('payments')
    return response.data
}
export const sendConversion = async (data) => {
    const user = getLocalStorage()
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': user.token
    }
    const response = await api.post(`conversion`, data, {"headers": headers})
    return response.data
}
export const sendLogin = async (data) => {
    const response = await api.post(`singin`, data)
    return response.data
}
export const getTransactions = async (userid) => {
    const response = await api.get(`transactions/${userid}`)
    if (response.data.status === "error") return
    const { user } = response.data.data
    return user.transactions
}
export const saveUser = async (data) => {
    const response = await api.post(`singup`, data)
    return response.data
}
export default api