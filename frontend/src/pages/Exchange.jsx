import { useState } from 'react';

import Form from '../components/Form.jsx';
import Input from '../components/FormInput.jsx';
import Dropdown from '../components/Select.jsx';
import Button from '../components/Button.jsx';
import FormRadio from '../components/Radio.jsx';
import ExchangeInfoModal from '../components/EnchangeInfoModal.jsx';

import { HttpClient } from '../library/HttpClient.js';
import getCurrency from '../library/getCurrency.js';

import { Grid, Typography } from "@mui/material";
import InfoIcon from '@mui/icons-material/Info';
import CurrencyExchangeIcon from '@mui/icons-material/CurrencyExchange';

import styles from './styles/Exchange.module.css';
import { useContext, Fragment } from 'react';
import { AuthContext } from '../context/AuthContext.jsx';

import { useSnackbar } from 'notistack'

const radioOptions = [
  {
    id: "boleto",
    name: "Boleto",
  },
  {
    id: "cartao",
    name: "Cartão",
  },
];

const Exchange = () => {
  const [originValue, setOriginValue] = useState("");
  const [destinyValue, setDestinyValue] = useState("0,00");

  const [originCurrency, setOriginCurrency] = useState("BRL");
  const [destinyCurrency, setDestinyCurrency] = useState("USD");
  const [paymentType, setPaymentType] = useState("boleto");

  const [openModal, setOpenModal] = useState(false);
  const [modalData, setModalData] = useState({});

  const { user, isAuthenticated } = useContext(AuthContext);

  const { enqueueSnackbar } = useSnackbar();

  const validateData = () => {
    let value = originValue.replace(',', '.');
    const points = (value.split('.').length - 1);

    if (points >= 2) {
      value = value.replace('.', '');

      if (points >= 3) {
        value = value.replace('.', '');
      }
    }

    if (value !== "") {
      value = parseFloat(value).toFixed(2);
      value = parseFloat(value);
    }

    if (originCurrency === destinyCurrency) {
      enqueueSnackbar('Selecione uma moeda diferente para efetuar a compra!', { variant: 'info' });
      return false
    }

    if (value == '' || value == 0) {
      enqueueSnackbar(`Informe um valor para comprar min:1000 max:100.000`, { variant: 'info' });
      return false;
    } else if (value < 1000) {
      enqueueSnackbar(`Compras só podem ser feitas acima de ${getCurrency(originCurrency)} 1000`, { variant: 'info' });
      return false;
    } else if (value > 100000) {
      enqueueSnackbar(`Compras só podem ser feitas abaixo de ${getCurrency(originCurrency)} 100.000`, { variant: 'info' });
      return false;
    }

    return true;
  }

  const handleChangeOriginCurrency = (data) => {
    setOriginCurrency(data);
    setDestinyValue("0,00");
    setModalData({});
  }

  const handleChangeDestinyCurrency = (data) => {
    setDestinyCurrency(data);
    setDestinyValue("0,00");
    setModalData({});
  }

  const formatPrice = (data) => {
    data = data.replace(/\D/g, "");
    data = data.replace(/(\d)(\d{2})$/, "$1,$2");
    data = data.replace(/(?=(\d{3})+(\D))\B/g, ".");

    return data;
  };

  const fetchData = () => {
    if ( ! validateData()) {
      return false;
    }

    let body = {
      origin_currency: originCurrency,
      destiny_currency: destinyCurrency,
      origin_value: originValue,
      payment_type: paymentType,
    };

    if (typeof user.current?.id !== 'undefined') {
      body.user_id = user.current.id;
    }

    HttpClient(
      "/exchange/fetch-data",
      {
        body,
        method: "GET"
      }
    ).then((resp) =>  resp.json())
     .then((data) => {
      setDestinyValue(data.destiny_value);
      setModalData(data);
      enqueueSnackbar('Compra efetuada com sucesso', { variant:'success' });
     })
     .catch((e) => {
      console.log(e.message);
      enqueueSnackbar('Algum erro ocorreu. Contate o suporte!', { variant:'success' });
    });
  }

  return (
    <>
      <ExchangeInfoModal
        open={openModal} handleClose={() => setOpenModal(!openModal)}
        modalData={{
          title: "Info do câmbio",
          total_value: originValue,
          origin_currency: originCurrency,
          destiny_currency: destinyCurrency,
          payment_type: paymentType,
          ...modalData
        }}
      />
      <div className={styles.main}>
        <h1>Faça o câmbio de moedas</h1>
        { ! isAuthenticated() ?
          <span>Faça <a href="/login">Login</a> ou <a href="/register">Registre-se</a> para registrar o histórico de compras.</span>
          : null
        }
        <div className={styles.form_row}>
          <Form>
            <Grid 
              container
              spacing={0.5}
              display="flex"
              alignItems="center"
              justifyContent="center"
            >
              <Grid item xs={6}>
                <Dropdown
                  value={originCurrency}
                  label="Moeda origem"
                  handleChange={(e) => handleChangeOriginCurrency(e.target.value)}
                />
              </Grid>
              <Grid item xs={6}>
                <Dropdown
                  value={destinyCurrency}
                  label="Moeda destino"
                  handleChange={(e) => handleChangeDestinyCurrency(e.target.value)}
                />
              </Grid>
            </Grid>
            <br />
            <Grid 
              container
              spacing={0.5}
              display="flex"
              alignItems="center"
              justifyContent="center"
            >
              <Grid item >
                <Input
                  label="Valor origem"
                  name="origin_currency"
                  variant="outlined"
                  value={originValue}
                  cbValueChanged={(data) => setOriginValue(formatPrice(data))}
                  InputProps={{
                    startAdornment: (
                      <Fragment>
                        <Typography>{getCurrency(originCurrency)}&nbsp;</Typography>
                      </Fragment>
                    )
                  }}
                />
              </Grid>
              <Grid item >
                <FormRadio
                  row
                  label="Modo de pagamento"
                  options={radioOptions}
                  onChange={(e) => setPaymentType(e.target.value)}
                />
              </Grid>
            </Grid>
          </Form>
        </div>
        <div className={styles.value_row}>
          <h1>{getCurrency(destinyCurrency)}&nbsp;{destinyValue}</h1>
          {Object.keys(modalData).length > 0 &&
            <Button
              variant="text"
              onClick={() => setOpenModal(!openModal)}
            >
              <InfoIcon fontSize="small"/>
          </Button>}
        </div>
        <div className={styles.fetch_button}>
          <Button
            variant="contained"
            onClick={() => fetchData()}
            color="success"
          >
            <CurrencyExchangeIcon fontSize="small"/>&nbsp;{isAuthenticated() ? <span>Comprar</span> :<span>Buscar</span>}
          </Button>
        </div>
      </div>
    </>
  );
}

export default Exchange;