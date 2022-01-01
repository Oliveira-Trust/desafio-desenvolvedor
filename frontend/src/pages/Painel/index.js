import { Error } from "../../components/FormSingup/Styles";
import Layout from "../../template/Layout";
import FormTaxTransactions from "../../components/FormTaxTransactions";
import { useAuth } from "../../contexts/authContext";

const PagePainel = () => {
  const {error, tax, handleTax } = useAuth()
  const handleTaxTransactionsSubmit = async (values) => {
      await handleTax(values)
  }
  return (
    <Layout>
      {error.error && <Error>{error.message}</Error>}
      {tax && <FormTaxTransactions handleSubmit={handleTaxTransactionsSubmit} taxTransaction={tax} />}
    </Layout>
  );
}
export default PagePainel