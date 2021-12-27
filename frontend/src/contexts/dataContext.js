import { createContext, useState, useEffect, useContext, useCallback } from 'react'
import { getCurrencies, getPaymentForms } from '../services/api'

const DataContex = createContext()

const DataProvider = ({ children }) => {
    const [ currencyBRL, setCurrencyBRL ] = useState('')
    const [ currencies, setCurrencies ] = useState([])
    const [ paymentsForm, setPaymentsForm ] = useState([])

    const handleLoadData = useCallback(async () => {
        const currenciesRequest = getCurrencies()
        const paymentsRequest = getPaymentForms()
        const [ currenciesResponse, paymentsResponse ] = await Promise.all([
            currenciesRequest,
            paymentsRequest
          ])
        const payments = paymentsResponse.data.data
        const { data } = currenciesResponse.data
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
    }, [])
    
    useEffect(()=>{
        handleLoadData()
    }, [handleLoadData])

    return (
        <DataContex.Provider value={{
            currencies,
            currencyBRL,
            payments: paymentsForm
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
