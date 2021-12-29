import axios from 'axios'
import { getToken } from '../auth/authReducer';

const api = axios.create({
    baseURL: "http://localhost:8080/",
    headers: {
        Authorization: getToken()
    }
});

export const getCurrencies = async () => {
    const response = await api.get('moedas')
    return response.data
}
export const getPaymentForms = async ()  => {
    const response =  await api.get('payments')
    return response.data
}
export const sendConversation = async (data)  => {
    const response =  await api.post(`conversion`, data)
    return response.data
}
export const sendLogin = async (data) => {
    const response =  await api.post(`singin`, data)
    return response.data
}
export const getTransactions = async (userid) => {
    const response =  await api.get(`transactions/${userid}`)
    if(response.data.status === "error") return 
    const { user } = response.data.data
    return user.transactions
}
export const saveUser = async (data) => {
    const response =  await api.post(`singup`, data)
    return response.data
}
export default api