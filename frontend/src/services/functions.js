
export const getLocalStorage = (key = 'secret_keys') => {
    return JSON.parse(localStorage.getItem(key)) || false
}
export const setLocalStorage = (values, key = 'secret_keys') => {
    localStorage.setItem(key, JSON.stringify(values))
}
export const removeLocalStorage = (key = 'secret_keys') => {
    localStorage.removeItem(key)
}
export const formatMoney = (value, code = 'BRL') => {
    const options = {
        minimumFractionDigits: 2,
        style: 'currency',
        currency: code
    }
    return parseFloat(value).toLocaleString('pt-BR', options)
}
export const formatDate = (value) => {
    const options = {year:'2-digit', month: '2-digit', day:'2-digit', hour:'numeric', minute:'numeric'}
    return (new Date(value)).toLocaleDateString('pt-BR', options)
}