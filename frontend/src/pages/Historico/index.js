import { useEffect, useState } from "react";
import { getTransactions } from "../../services/api";
import { getLocalStorage } from "../../services/functions";
import Layout from "../../template/Layout";
import TableConversion from '../../components/TableConversion'

const PagePainel = ()=>{
  const [transactions, setTransactions] = useState([])
  useEffect(()=>{
    (async()=>{
        const user = getLocalStorage()
        const tResponse = await getTransactions(user.id)
        setTransactions(c=>tResponse)
    })()
  },[])

    return (
      <Layout historico={true}>
        <TableConversion title="Histórico de conversões" transactionsUser={transactions}/>
    </Layout>
      );
} 
export default PagePainel