import { useEffect } from "react";
import { useHistory } from "react-router";
import FormLogin from "../../components/FormLogin";

import { Error } from "../../components/FormSingup/Styles";
import { useAuth } from "../../contexts/authContext";
import { getLocalStorage } from "../../services/functions";
import Layout from "../../template/Layout";

const PageLogin = () => {  
  const { singIn, error } = useAuth()
  const history = useHistory()
  const handleLogin = async (values) => {
        await singIn(values)
        history.push('/')
  }
  useEffect(()=>{
    const user = getLocalStorage()
    if(user){
      history.push('/');
    }
  },[history])
  return (
    <Layout>
      {error.error &&  <Error>{error.message}</Error>}
      <FormLogin handleLogin={handleLogin}/>
    </Layout>
  );
}
export default PageLogin