import { createContext, useState, useContext, useEffect, useCallback } from 'react'
import api, { getTaxTransactions, saveTaxTransactions, sendLogin } from '../services/api'
import { getLocalStorage, removeLocalStorage, setLocalStorage } from '../services/functions'

const AuthContex = createContext()
const AuthProvider = ({ children }) => {
    const [error, setError] = useState({ error: false, message: '' })
    const [sucess, setSucess] = useState({ show: false, message: '' })
    const [tax, setTax] = useState('')
    const [data, setData] = useState(() => {
        const user = getLocalStorage()
        if (user) {
            return user
        }
        return false
    })
    const singIn = async (values) => {
        const response = await sendLogin(values)
        if (response.status === 'sucesso') {
            const { user } = response
            api.defaults.headers.Authorization = `${user.token}`
            setData({ ...user })
            setLocalStorage(user)
            if(error.error) setError({ error: false, message: '' })
        } else {
            setError({ error: true, message: response.message })
        }
    }
    const handleError = (message) => {
        setError({ error: true, message })
    }
    const singOut = () => {
        setData(false)
        removeLocalStorage()
    }
    const loadTax = useCallback(async()=>{
        const response = await getTaxTransactions()
        if(response.status === 'sucesso') {
            setTax(response.data)
        } else {
            setError({ error: true, message: response.message })
        }
    },[])
    const handleTax = async (values) => {
        const response = await saveTaxTransactions(values)
        if (response.status === 'sucesso') {
            loadTax()
            setSucess({show: true, message: response.message})
        } else {
            setError({ error: true, message: response.message })
        }
    }
    useEffect(() => {
        if(getLocalStorage()){
            (async () => {
                loadTax()
            })()
        }
    }, [data, loadTax])
    return (
        <AuthContex.Provider value={{ 
            user: data.user,
            singIn,
            singOut,
            error,
            handleError,
            tax,
            handleTax,
            sucess
             }}>
            {children}
        </AuthContex.Provider>
    )
}
const useAuth = () => {
    const context = useContext(AuthContex)
    if (context === undefined) {
        throw new Error("Sem Contexto")
    }
    return context
}
export { AuthProvider, useAuth }