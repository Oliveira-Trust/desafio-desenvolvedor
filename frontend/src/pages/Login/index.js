import { useEffect, useState } from "react";
import { useHistory } from "react-router";
import FormLogin from "../../components/FormLogin";
import { Error } from "../../components/FormSingup/Styles";
import { sendLogin } from "../../services/api";
import { getLocalStorage, setLocalStorage } from "../../services/functions";
import Layout from "../../template/Layout";

const PageLogin = () => {
  const [ error, setError ] = useState('')
  const history = useHistory()
  const handleLogin = async (values) => {
    try{
      const response = await sendLogin(values)
      if(response.status === 'sucesso') {
        setLocalStorage(response.user)
        setError(false)
        history.push('/');
      } else {
        setError(c => response.message)
      }
    }catch(e){
      setError(c => 'Desculpe! Estamos com problemas técnicos no momento.')
    }
  }
  useEffect(()=>{
    const user = getLocalStorage()
    if(user){
      history.push('/');
    }
  },[history])
  return (
    <Layout>
      {error &&  <Error>{error}</Error>}
      <FormLogin handleLogin={handleLogin}/>
    </Layout>
  );
}
export default PageLogin