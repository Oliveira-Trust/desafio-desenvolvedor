import { Error, Sucess } from "../../components/FormSingup/Styles";
import Layout from "../../template/Layout";
import FormTaxTransactions from "../../components/FormTaxTransactions";
import { useAuth } from "../../contexts/authContext";

const PagePainel = () => {
  const {error, tax, handleTax, sucess } = useAuth()
  const handleTaxTransactionsSubmit = async (values) => {
      await handleTax(values)
  }
  return (
    <Layout>
      {error.error && <Error>{error.message}</Error>}
      {sucess.show && <Sucess>{sucess.message}</Sucess>}
      {tax && <FormTaxTransactions handleSubmit={handleTaxTransactionsSubmit} taxTransaction={tax} />}
    </Layout>
  );
}
export default PagePainel