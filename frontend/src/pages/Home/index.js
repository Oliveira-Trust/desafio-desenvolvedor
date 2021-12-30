import { useEffect, useState } from "react";
import { getCurrencies, getPaymentForms } from "../../services/api";
import Layout from "../../template/Layout";
import CardConvertion from "../../components/CardConvertion";

const PageHome = () => {
  const [ currencies, setCurrencies] = useState([])
  const [ BRL, setBRL] = useState('')
  const [ payments, setPayments] = useState([])
  useEffect(()=>{
    (async()=>{
      const cResponse = await getCurrencies()
      const pResponse = await getPaymentForms()
      const brlData = {
          code: cResponse[0].code,
          name: cResponse[0].name.split('/')[0]
      }      
      setBRL(c => brlData)
      const cData = cResponse.map(c=>{
        return {
          code: c.codein,
          name: c.name.split('/')[1]
        }
      })
      setCurrencies(c => cData)
      setPayments(c => pResponse.data)
    })()
  },[])
  return (
    <Layout>
      <CardConvertion currencyBRL={BRL}  currencies={currencies} paymentTypes={payments}  />
    </Layout>
  );
}
export default PageHome