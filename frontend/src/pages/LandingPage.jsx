import { useNavigate } from "react-router-dom";
import Button from '../components/Button.jsx';

import styles from './styles/LandingPage.module.css';

const LandingPage = () => {
  const navigate = useNavigate();
  const redirectExchange = () => {
    navigate('/exchange');
  }

  return(
    <div className={styles.main}>
      <h1>Bem vindo ao Exchangify, seu app de câmbio de moedas.</h1>
      <span>Consulte o valor do câmbio de moedas, incluindo taxas, valores líquidos e brutos.</span>
      <Button
        variant="contained"
        onClick={redirectExchange}
        color="success"
      >
        Começar
      </Button>
    </div>
  );
}

export default LandingPage;