import { useState } from "react";
import { useHistory } from "react-router";
import { Error } from "../../components/FormSingup/Styles";
import { saveUser } from "../../services/api";
import { setLocalStorage } from "../../services/functions";
import Layout from "../../template/Layout";
import FormSingup from "../../components/FormSingup";

const PageLogin = () => {
  const [error, setError] = useState(false)
  const history = useHistory()
  const singUp = async (values) => {
    try {
      const response = await saveUser(values)
      if (response.status === 'sucesso') {
        setLocalStorage(response.user)
        history.push('/');
        setError(false)
      } else {
        setError(c => response.message)
      }
    } catch (e) {
      setError(c => 'Desculpe! Estamos com problemas técnicos no momento.')
    }
  }
  return (
    <Layout>
      {error && <Error>{error}</Error>}
      <FormSingup handleSingup={singUp} />
    </Layout>
  );
}
export default PageLogin