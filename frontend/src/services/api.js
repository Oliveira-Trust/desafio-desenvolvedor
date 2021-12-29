import axios from 'axios'

const api = axios.create({
    baseURL: "http://localhost:8080/"
});

export const getCurrencies = async () => {
    const response = await api.get('moedas')
    return response.data
}
export const getPaymentForms = async ()  => {
    const response =  await api.get('payments')
    return response.data
}
export const sendConversation = async (data, iduser = 1)  => {
    const response =  await api.post(`conversion/${iduser}`, data)
    return response.data
}
export const sendLogin = async (data) => {
    const response =  await api.post(`singin`, data)
    return response.data
}
export const getTransactions = async (userid) => {
    const response =  await api.get(`transactions/${userid}`)
    return response.data.data.user.transactions
}