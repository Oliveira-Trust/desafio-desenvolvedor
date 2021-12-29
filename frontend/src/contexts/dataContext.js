import { createContext, useState, useEffect, useContext, useCallback, useReducer } from 'react'
import { getCurrencies, getPaymentForms, getTransactions } from '../services/api'

const DataContex = createContext()

const DataProvider = ({ children }) => {
    const [ currencyBRL, setCurrencyBRL ] = useState('')
    const [ currencies, setCurrencies ] = useState([])
    const [ paymentsForm, setPaymentsForm ] = useState([])
    const [ transactions, setTransactions ] = useState([])

    const handleLoadData = useCallback(async () => {
        const currenciesResponse = await getCurrencies()
        const paymentsResponse = await getPaymentForms()
        const transactionsResponse = await getTransactions(1)
        const payments = paymentsResponse.data
        const { data } = currenciesResponse
        const brl = {
            code: data[0].code,
            name: data[0].name.split('/')[0]
        }
        const currenciesData = data.map((currency)=>{
            return {
                code: currency.codein,
                name: currency.name.split('/')[1]
            }
        })
        setPaymentsForm(c => payments)
        setCurrencies(currenciesData)
        setCurrencyBRL(c => brl);
        setTransactions(c => transactionsResponse)
    }, [])
    
    useEffect(()=>{
        handleLoadData()
    }, [handleLoadData])
    return (
        <DataContex.Provider value={{
            currencies,
            currencyBRL,
            payments: paymentsForm,
            transactions
        }}>
            {children}
        </DataContex.Provider>
    )
}
const useData = () => {
    const context = useContext(DataContex)
    if (context === undefined) {
        throw new Error("Este contexto não esta disponivel")
    }
    return context
}
export { DataProvider, useData }
