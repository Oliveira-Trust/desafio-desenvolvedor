
export const getLocalStorage = (key = 'secret_keys') => {
    return JSON.parse(localStorage.getItem(key)) || false
}
export const setLocalStorage = (values, key = 'secret_keys') => {
    localStorage.setItem(key, JSON.stringify(values))
}
export const removeLocalStorage = (key = 'secret_keys') => {
    localStorage.removeItem(key)
}