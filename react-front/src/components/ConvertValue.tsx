// @flow 
import * as React from 'react';
import { useKeycloak } from "@react-keycloak/web";
import { Button,
    AppBar, 
    Box, 
    Card, 
    Container, 
    FormControl, 
    Grid, 
    InputLabel,
    MenuItem, 
    Paper, 
    Select, 
    Toolbar, 
    Typography,
    TextField,
    Divider
} from '@mui/material';
import { useEffect } from 'react';
import { useState } from 'react';
import axios from 'axios';
import * as Yup from 'yup';
import { TableConvertedValue } from './TableConvertedValue';
import { toast } from 'react-toastify';

type Props = {
    
};

export const ConvertValue = (props: Props) => {
    const {initialized, keycloak} = useKeycloak();
    const [convertions, setConversions] = useState([]);
    
    const defaultData = {
        "paymentMethod": "",
        "originValue": "",
        "convertedCurrency": ""
      }
      const [data, setData] = useState(defaultData);
    
    if(!initialized){
        return <div>Carregando...</div>
    }

    const getDataConvertions = () =>{
        axios.get("http://localhost:8081/api/converted-values", {
            headers: {
                Authorization: `Bearer ${keycloak?.token}`,
            },
        }).then((response) => {
            setConversions(response.data.data);
            return;
        }).catch((error) => {
            console.log(error);
        })
    }
    
    // eslint-disable-next-line react-hooks/rules-of-hooks
    useEffect(() => {
        getDataConvertions();
    }, []);

    const validateForm = async () =>{

        try{
            const schema = Yup.object().shape({
                originValue: Yup.number()
                .required('EAN is required.')
                .min(1000, 'Valor mínimo deve ser R$ 1.000,00.') 
                .max(10000000, 'Valor máximo deve ser R$ 100.000,00.'),
                paymentMethod: Yup.string().required(),
                convertedCurrency: Yup.string().required()
            })
    
            await schema.validate(data, { abortEarly: false });
    
            handleConvesion();
        }catch (err) {
            if (err instanceof Yup.ValidationError) {
              toast.error(err?.errors[0]);
              console.log('err', err);
            }
          }   
    }

    const handleConvesion = () => {
        axios.post("http://localhost:8081/api/converted-values", data, {
            headers: {
                Authorization: `Bearer ${keycloak?.token}`,
            },
        }).then((response) => {
            getDataConvertions();
            return;
        }).catch((error) => {
            console.log(error);
        })
    }

    const handleLogout = () => {
        keycloak?.logout();
    }
    
    return (
        <>
            <>
                <Box sx={{ flexGrow: 1 }}>
                    <AppBar position="static">
                        <Toolbar>
                            {/* <MenuIcon /> */}
                            <Typography>
                                Olá {keycloak?.idTokenParsed?.name} /
                            </Typography>
                            <Typography>
                                <Button onClick={handleLogout} style={{color: "#fff"}}>Logout</Button>
                            </Typography>
                        </Toolbar>
                    </AppBar>
                </Box>
            </>
            <>
                <Container maxWidth="sm">
                    <Paper style={{marginTop: "100px", padding: "20px", textAlign: "center"}}>
                        <span style={{fontSize: "20px"}}>CONVERSOR DE MOEDA</span>
                    </Paper>
                    <Paper square elevation={3} style={{marginTop: "50px", padding: "20px"}}>
                        <Grid container spacing={4} xs direction='row' justifyContent='center' alignItems="center">
                            <Grid item xs={6}>
                                <FormControl fullWidth>
                                    <InputLabel id="demo-simple-select-label">Moeda Destino</InputLabel>
                                    <Select
                                        labelId="demo-simple-select-label"
                                        size="small"
                                        id="demo-simple-select"
                                        value={data.convertedCurrency}
                                        label="Moeda Destino"
                                        onChange= {(e) => setData({...data, convertedCurrency: e.target.value})}
                                    >
                                        <MenuItem value={"USD"}>USD</MenuItem>
                                        <MenuItem value={"EUR"}>EUR</MenuItem>
                                    </Select>
                                </FormControl>
                            </Grid>
                            <Grid item xs={6}>
                                <TextField
                                    id="outlined-number"
                                    label="Valor"
                                    type="number"
                                    size='small'
                                    value={data.originValue}
                                    onChange= {(e) => setData({...data, originValue: e.target.value})}
                                    />
                            </Grid>
                            <Grid item xs={6}>
                                <FormControl fullWidth>
                                    <InputLabel id="demo-simple-select-label">Forma de Pagamento</InputLabel>
                                    <Select
                                        labelId="demo-simple-select-label"
                                        size="small"
                                        id="demo-simple-select"
                                        value={data.paymentMethod}
                                        label="Forma de Pagamento"
                                        onChange= {(e) => setData({...data, paymentMethod: e.target.value})}
                                    >
                                        <MenuItem value={"BANK_SLIP"}>Boleto Bancário</MenuItem>
                                        <MenuItem value={"CREDIT_CARD"}>Cartão de Crédito</MenuItem>
                                    </Select>
                                </FormControl>
                            </Grid>
                            <Grid item xs={6}>
                                <Button variant='contained' onClick={validateForm}>Enviar</Button>
                            </Grid>
                        </Grid>
                    </Paper>
                </Container>
                <Paper elevation={3} style={{marginTop: "50px"}}>
                    <TableConvertedValue rows={convertions} />
                </Paper>
            </>
        </>
    );
};