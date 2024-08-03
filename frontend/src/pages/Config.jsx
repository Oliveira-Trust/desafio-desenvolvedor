import { Alert, Grid, Snackbar, Typography } from '@mui/material';
import Tooltip from '@mui/material/Tooltip';
import InfoIcon from '@mui/icons-material/Info';

import Form from '../components/Form'

import Input from '../components/FormInput';
import { useContext, useState } from 'react';
import Button from '../components/Button';
import { HttpClient } from '../library/HttpClient';
import { AuthContext } from '../context/AuthContext';
import { formatPrice } from '../library/Format.js';
import { useEffect } from 'react';
import { useSnackbar } from 'notistack';

import styles from './styles/Config.module.css';
import { Fragment } from 'react';


const Config = () => {
  const [cardPaymentFee, setCardPaymentFee] = useState(""); 
  const [ticketPaymentFee, setTicketPaymentFee] = useState("");
  const [minValueExchange, setMinValueExchange] = useState("");
  const [minValueExchangeFee, setMinValueExchangeFee] = useState("");
  const [companyEmailAddress, setCompanyEmailAddress] = useState('');

  const { enqueueSnackbar } = useSnackbar();

  const { isAdmin } = useContext(AuthContext);

  const fetchData = () => {
    HttpClient(
      "/config/get-data", 
      { method: "GET"}
    )
      .then((resp) => resp.json())
      .then((data) => {
        setCardPaymentFee(data.fee_values.payment_type_fee.cartao);
        setTicketPaymentFee(data.fee_values.payment_type_fee.boleto);
        setMinValueExchange(data.fee_values.min_value_fee.min_value);
        setMinValueExchangeFee(data.fee_values.min_value_fee.percentage);
        setCompanyEmailAddress(data.company_email_address);
      });
  }

  useEffect(() => {
    if ( ! isAdmin()) {
      return;
    }

    fetchData();
  }, []);

  const saveConfig = () => {
    if ( ! isAdmin() || ! validateData()) {
      return;
    }

    HttpClient(
      "/config/edit-config",
      {
        body: {
          card_payment_fee: cardPaymentFee.replace(/[^0-9.]/g, ""),
          ticket_payment_fee: ticketPaymentFee.replace(/[^0-9.]/g, ""),
          min_value_exchange: minValueExchange.replace(",", ".").replace(".", ""),
          min_value_exchange_fee: minValueExchangeFee.replace(/[^0-9.]/g, ""),
          company_email_address: companyEmailAddress,
        },
        method: "PUT",
      }
    ).then(() => {
      enqueueSnackbar('Configuração salva!', { variant: 'success' });
    });
  }

  const validateData = () => {
    if (
      cardPaymentFee === '' ||
      ticketPaymentFee === '' ||
      minValueExchange === '' ||
      minValueExchangeFee === '' ||
      companyEmailAddress === ''
    ) {
      enqueueSnackbar('Preencha todos os dados!', { variant: 'error' });
      return false;
    }

    if (
      ! companyEmailAddress.includes('@') ||
      ! companyEmailAddress.includes('.com')
    ) {
      enqueueSnackbar('Informe um email válido', { variant: 'error' });
      return false;
    }

    return true;
  }

  return (
    <div className={styles.main}>
      <h1>Configurações do sistema</h1>
      <span>Consulte ou altere as configs do sistema</span>
      <div className={styles.config_form}>
      <Form callbackSubmit={() => saveConfig()}>
					<Grid	container spacing={1}>
						<Grid
              item
              xs={12}
              md={6}
              display="flex"
              flexDirection="row"
              justifyContent="center"
              alignItems="center"
              marginTop="1%"
            >
							<Input
								label="Taxa - pagamento cartão"
								name="payment_fee"
								variant="outlined"
                value={cardPaymentFee}
                cbValueChanged={(data) => setCardPaymentFee(data)}
                InputProps={{
                  endAdornment: (
                    <Fragment>
                      <Typography>%</Typography>
                    </Fragment>
                  )
                }}
							/>
              &nbsp;
              <Tooltip title="Informe a porcentagem. ex: 7.36%" placement="top-start">
                <InfoIcon />
              </Tooltip>
						</Grid>
						<Grid
              item
              xs={12}
              md={6}
              display="flex"
              flexDirection="row"
              justifyContent="center"
              alignItems="center"
              marginTop="1%"
            >
							<Input
								label="Taxa - pagamento boleto"
								name="exchange_fee"
								variant="outlined"
                value={ticketPaymentFee}
                cbValueChanged={(data) => setTicketPaymentFee(data)}
                InputProps={{
                  endAdornment: (
                    <Fragment>
                      <Typography>%</Typography>
                    </Fragment>
                  )
                }}
							/>
              &nbsp;
              <div className={styles.tooltip_row}>
                <Tooltip title="Informe a porcentagem. ex: 1.75%" placement="top-start">
                  <InfoIcon />
                </Tooltip>
              </div>
						</Grid>
            <Grid
              item
              xs={12}
              md={6}
              display="flex"
              flexDirection="row"
              justifyContent="center"
              alignItems="center"
              marginTop="1%"
            >
							<Input
								label="Taxa de câmbio"
								name="min_value_exchange"
								variant="outlined"
                value={minValueExchangeFee}
                cbValueChanged={(data) => setMinValueExchangeFee(data)}
                InputProps={{
                  endAdornment: (
                    <Fragment>
                      <Typography>%</Typography>
                    </Fragment>
                  )
                }}
							/>
              &nbsp;
              <Tooltip title="Informe o valor mínimo para aplicar a taxa de pagamento" placement="top-start">
                <InfoIcon />
              </Tooltip>
						</Grid>
						<Grid
              item
              xs={12}
              md={6}
              display="flex"
              flexDirection="row"
              justifyContent="center"
              alignItems="center"
              marginTop="1%"
            >
							<Input
								label="Taxa - valor min"
								name="min_value_exchange_fee"
								variant="outlined"
                value={minValueExchange}
                cbValueChanged={(data) => setMinValueExchange(formatPrice(data))}
                InputProps={{
                  startAdornment: (
                    <Fragment>
                      <Typography>$&nbsp;</Typography>
                    </Fragment>
                  )
                }}
							/>
              &nbsp;
              <Tooltip title="Informe o valor da taxa que será aplicada se o preço do câmbio for maior que o valor mínimo da taxa. ex: valor > 3000 3% taxa" placement="top-start">
                <InfoIcon />
              </Tooltip>
						</Grid>
						<Grid item xs={12} marginTop="1%">
							<Input
								label="Email da empresa"
								name="email"
								variant="outlined"
                value={companyEmailAddress}
                cbValueChanged={(data) => setCompanyEmailAddress(data)}
							/>
						</Grid>
					</Grid>
					<div className={styles.save_button}>
						<Button
							variant="contained"
							type="submit"
							color="success"
						>
							Salvar
						</Button>
					</div>
				</Form>
      </div>
    </div>
  );
}

export default Config;