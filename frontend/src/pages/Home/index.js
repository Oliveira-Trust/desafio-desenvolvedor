import { useEffect, useState } from "react";
import { getCurrencies, getPaymentForms } from "../../services/api";
import Layout from "../../template/Layout";
import CardConvertion from "../../components/CardConvertion";
import { getLocalStorage } from "../../services/functions";
import { Error } from "../../components/FormSingup/Styles";

const PageHome = () => {
  const [currencies, setCurrencies] = useState([])
  const [BRL, setBRL] = useState('')
  const [payments, setPayments] = useState([])
  const [error, setError] = useState(false)
  const user = getLocalStorage()

  useEffect(() => {
    (async () => {
      try {
        const cResponse = await getCurrencies()
        const pResponse = await getPaymentForms()
        const brlData = {
          code: cResponse[0].code,
          name: cResponse[0].name.split('/')[0]
        }
        setBRL(c => brlData)
        const cData = cResponse.map(c => {
          return {
            code: c.codein,
            name: c.name.split('/')[1]
          }
        })
        setCurrencies(c => cData)
        setPayments(c => pResponse.data)
      } catch (e) {
        setError(c => 'Desculpe! Estamos com problemas técnicos no momento.')
      }
    })()
  }, [])
  return (
    <Layout user={user}>
      {error && <Error>{error}</Error>}
      <CardConvertion currencyBRL={BRL} currencies={currencies} paymentTypes={payments} />
    </Layout>
  );
}
export default PageHome