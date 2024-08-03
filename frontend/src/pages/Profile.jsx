import { useContext } from 'react';

import Box from '@mui/material/Box';

import HistoryIcon from '@mui/icons-material/History';

import { AuthContext } from '../context/AuthContext';
import { HttpClient } from '../library/HttpClient.js';

import { useState, useEffect } from 'react';

import styles from './styles/Profile.module.css';
import DataTable from '../components/DataTable.jsx';

const columns = [
  { field: 'created_at', headerName: 'Comprado em', width: 150 },
  { field: 'destiny_currency', headerName:   'Moeda destino', width: 70 },
  { field: 'destiny_currency_price', headerName: 'Valor moeda destino', width: 70 },
  { field: 'destiny_value', headerName: 'Valor destino', width: 100 },
  { field: 'exchange_fee', headerName: 'Taxa câmbio', width: 100 },
  { field: 'net_value', headerName: 'Valor líquido', width: 120 },
  { field: 'origin_currency', headerName: 'Moeda origem', width: 70 },
  { field: 'origin_value', headerName: 'valor destino', width: 120 },
  { field: 'payment_fee', headerName: 'Taxa pagamento', width: 100 },
  { field: 'payment_type', headerName: 'Tipo pagamento', width: 70 },
];

const Profile = () => {
  const [rows, setRows] = useState([{}]);

  const { user, isAuthenticated, firstName, userProfilePicture } = useContext(AuthContext);

  useEffect(() => {
    fetchExchangeUser();
  }, []);

  const fetchExchangeUser = () => {
    HttpClient(
      "/exchange/get-exchange-user",
      {
        body: {
          user_id: user?.current?.id,
        },
        method: "GET",
      }
    )
    .then((resp) => resp.json())
    .then((data) => {
      setRows(data)
    });
  }

  return (
    <div className={styles.main}>
      {isAuthenticated() &&
        <>
          <div className={styles.profile_row}>
            <Box
              component="img"
              sx={{
                height: 100,
                width: 100,
                borderRadius: "50%",
                objectFit: "cover",
                marginRight: "10%"
              }}
              alt="Profile Picture"
              src={userProfilePicture()}
            />
            <h1>{firstName()}</h1>
          </div>
          <div className={styles.purchases_row}>
            <h1><HistoryIcon fontSize="large"/>&nbsp;Informações sobre compras</h1>
            <DataTable rows={rows} columns={columns} />
          </div>
        </>
      }
    </div>
  )
}

export default Profile;