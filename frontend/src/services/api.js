import axios from 'axios'

const api = axios.create({
    baseURL: "http://localhost:8001/"
});

export const getCurrencies = async () => {
    return await api.get('moedas')    
}
export const getPaymentForms = async ()  => {
    return await api.get('payments')
}

export const sendConversation = async (data, iduser = 1)  => {
    return await api.post(`conversion/${iduser}`, data)
}

export const sendLogin = async (data) => {
    return await api.post(`singin`, data)
}