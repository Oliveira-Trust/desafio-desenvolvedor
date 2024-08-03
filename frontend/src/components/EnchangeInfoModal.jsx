import * as React from 'react';

import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Modal from '@mui/material/Modal';
import MailIcon from '@mui/icons-material/Mail';
import { useSnackbar } from 'notistack';

import Button from './Button.jsx';

import getCurrency from '../library/getCurrency.js';
import { HttpClient } from '../library/HttpClient.js';

import { useContext } from 'react';
import { AuthContext } from '../context/AuthContext.jsx';

import styles from './styles/ExchangeInfoModal.module.css';

const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 600,
  bgcolor: 'background.paper',
  border: '2px solid #000',
  boxShadow: 24,
  p: 4,
};

const ExchangeInfoModal = (props) => {
  const data = props.modalData;

  const { user, isAuthenticated } = useContext(AuthContext);
  const { enqueueSnackbar } = useSnackbar();
  
  const getPaymentType = (data) => {
    if (data === 'cartao') {
      return 'Cartão'
    } else {
      return 'Boleto';
    }
  }

  const handleSendEmail = () => {
    if ( ! user?.current?.id || ! data.exchange_user_id) {
      return;
    }

    HttpClient(
      "/marketing/transactional-email",
      {
        body: {
          user_id: user?.current?.id,
          data_id: data.exchange_user_id,
          type: 'purchase_concluded',
        },
        method: "GET"
      }
    )
      .then(() => {
        enqueueSnackbar('Recibo enviado por Email', { variant: 'success' });
      })
      .catch((e) => {
        console.log(e.message);
        enqueueSnackbar('Algum erro ocorreu. Contate o suport', { variant: 'success' });
      });
  }

  return (
    <div>
      <Modal
        open={props.open}
        onClose={props.handleClose}
        aria-labelledby="modal-modal-title"
        aria-describedby="modal-modal-description"
      >
        <Box sx={style}>
          <Typography id="modal-modal-title" variant="h6" component="h2">
            {data.title}
          </Typography>
          <Typography id="modal-modal-description" sx={{ mt: 2 }}>
            <span>Moeda de origem: <strong>{data.origin_currency}</strong></span>
            <br />
            <span>Moeda de destino: <strong>{data.destiny_currency}</strong></span>
            <br />
            <span>Valor para conversão: <strong>{getCurrency(data.origin_currency)} {data.total_value}</strong></span>
            <br />
            <span>
              Forma de pagamento: <strong>{getPaymentType(data.payment_type)}</strong>
            </span>
            <br />
            <span>
              Valor de {data.destiny_currency}: <strong>{getCurrency(data.destiny_currency)} {data.destiny_currency_price}</strong>
            </span>
            <br />
            <span>
              Valor comprado em {data.destiny_currency}: <strong>{getCurrency(data.destiny_currency)}{data.destiny_value}</strong>
            </span>
            <br />
            <span>
              Taxa de pagamento: <strong>{getCurrency(data.origin_currency)} {data.payment_fee}</strong>
            </span>
            <br />
            <span>
              Taxa de conversão: <strong>{getCurrency(data.origin_currency)} {data.exchange_fee}</strong>
            </span>
            <br />
            <span>
              Valor utilizado para conversão descontando as taxas: <strong>{getCurrency(data.origin_currency)} {data.net_value}</strong>
            </span>
          </Typography>
          {isAuthenticated() &&
          <div className={styles.mail_row}>
            <Button
              variant="contained"
              color="success"
              onClick={handleSendEmail}
            >
              <MailIcon />&nbsp;Receber por email
            </Button>
          </div>}
        </Box>
      </Modal>
    </div>
  );
}

export default ExchangeInfoModal;