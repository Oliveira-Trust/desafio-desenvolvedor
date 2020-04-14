import React, { useState, useEffect } from "react";
import { makeStyles, createMuiTheme, ThemeProvider } from '@material-ui/core/styles';
import { Link } from "react-router-dom";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import Divider from "@material-ui/core/Divider";
import FormControl from "@material-ui/core/FormControl";
import PageBase from "../../../components/PageBase";
import styles from "./styles";
import { useDispatch } from "react-redux";
import api from "../../../services/api";
import MenuItem from '@material-ui/core/MenuItem';
import Select from '@material-ui/core/Select';
import InputLabel from '@material-ui/core/InputLabel';
import { FormHelperText, Grid } from "@material-ui/core";
import translateStatus from '../helpers'
import { green, red } from '@material-ui/core/colors';

const useStyles = makeStyles((theme) => ({
  formControl: {
    marginRight: theme.spacing(2),
    marginBottom: theme.spacing(1),
    minWidth: 120,
  },
  selectEmpty: {
    marginTop: theme.spacing(2),
  }
}))

const theme = createMuiTheme({
  palette: {
    primary: green,
    secondary: red
  },
});

const OrderForm = (props) => {
  const classes = useStyles()
  const dispatch = useDispatch()
  const [editMode, setEditMode] = useState(false)
  
  const [order, setOrder] = useState({
    quantity_ordered: '',
    client: '',
    product: ''
  })

  const [clients, setClients] = useState([])
  const [products, setProducts] = useState([])
  const [selectedProduct, setSelectedProduct] = useState()
  const [orderTotal, setOrderTotal] = useState()
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    api.get('/client')
      .then((res) => {
        setClients(res.data.data)
      })
    api.get('/product/')
      .then((res) => {
        setProducts(res.data.data)
      })
    if (props.match.params.order) {
      setEditMode(true)
      api.get(`/order/${props.match.params.order}`)
        .then((res) => {
          let editOrder = res.data.data
          setSelectedProduct(editOrder.product)
          editOrder.product = editOrder.product.id
          editOrder.client = editOrder.client.id
          setOrder(editOrder)
          setOrderTotal(editOrder.total)
          if (editOrder.status !== 'OPEN') {
            setLoading(true)
          }
        })
      }
  },[])

  const handleSubmit = (event) => {
    event.preventDefault()
    setLoading(true)
    if (editMode) {
      order.total = orderTotal
      console.log(order.total)
      api.patch(`/order/${order.id}`, order)
      .then(() => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Pedido alterado com sucesso`})
          props.history.push('/pedidos')
        })
    } else {
      api.post('/order', order)
      .then(() => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Pedido criado com sucesso`})
          props.history.push('/pedidos')
        })
    }
  }

  const handleProductChange = (prodId) => {
    setOrder({...order, product: prodId})
    products.map((prod) => {
        if(prod.id === prodId) {
          setSelectedProduct(prod)
        }
    })
  }

  const handleQuantityChange = (quantity) => {
    setOrder({...order, quantity_ordered: quantity})
    setOrderTotal(selectedProduct.price * quantity)
  }

  const handleStatusChange = (type) => {
    setLoading(true)
    if (type === 'pay') {
      api.patch(`/order/${order.id}`, {status: 'PAID'})
      .then(() => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Pedido pago com sucesso`})
          props.history.push('/pedidos')
        })
    } else if (type === 'cancel') {
      api.patch(`/order/${order.id}`, {status: 'CANCELLED'})
      .then(() => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Pedido cancelado com sucesso`})
          props.history.push('/pedidos')
        })
    }
  }

  return (
    <PageBase title={editMode ? "Editar Pedido" : "Novo Pedido"}>
      <form autoComplete="off" onSubmit={handleSubmit}>

        <Grid container spacing={2} style={{marginTop: 16}}>
          <Grid item lg={6} md={6} sm={12} xs={12}>
            {/* Client Select */}
            <FormControl fullWidth className={classes.formControl}>
              <InputLabel id="client-label">Cliente</InputLabel>
              <Select
                labelId="client-label"
                id="client-select"
                value={order.client}
                onChange={(e) => setOrder({...order, client: e.target.value})}
              >
                {clients.map(cli => <MenuItem key={cli.id} value={cli.id}>{cli.name}</MenuItem>)}
              </Select>
            </FormControl>
          </Grid>
          <Grid item lg={6} md={6} sm={12} xs={12}>
            {/* Product Select */}
            <FormControl fullWidth className={classes.formControl}>
              <InputLabel id="product-label">Produto</InputLabel>
              <Select
                labelId="product-label"
                id="product-select"
                value={order.product}
                onChange={(e) => handleProductChange(e.target.value)}
              >
                {products.map(prod => <MenuItem key={prod.id} value={prod.id} onClick={() => setSelectedProduct(prod)}>{prod.name}</MenuItem>)}
              </Select>
              {selectedProduct && <FormHelperText>{`Valor unitário: ${selectedProduct.price.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}`}</FormHelperText>}
            </FormControl>
          </Grid>
        </Grid>
        <Grid container spacing={2}>
          <Grid item lg={8} md={8} sm={12} xs={12}>
            {/* Quantity */}
            <TextField
              label="Quantidade"
              type="number"
              fullWidth
              className={classes.formControl}
              value={order.quantity_ordered}
              required
              helperText={selectedProduct && `Quantidade disponível do produto: ${selectedProduct.available_quantity}`}
              InputProps={ selectedProduct && { inputProps: { min: 1, max: selectedProduct.available_quantity } }}
              onChange={(e) => handleQuantityChange(e.target.value)}
            />
          </Grid>
          <Grid item lg={4} md={4} sm={12} xs={12}>
            {/* Total */}
            <TextField
              style={{marginTop: 16}}
              helperText="Total a pagar"
              fullWidth
              InputProps={{
                readOnly: true,
              }}
              value={orderTotal ? orderTotal.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) : ''}
              className={classes.formControl}
            />
          </Grid>
        </Grid>
        {editMode && 
          <Grid container style={{marginTop: 20}}>
            <Grid item lg={4} md={4} sm={12} xs={12}>
              {/* Status */}
              <TextField
                helperText="Status"
                fullWidth
                InputProps={{
                  readOnly: true,
                }}
                value={order && order.status ? translateStatus(order.status) : ''}
                className={classes.formControl}
              />
            </Grid>
            {order.status === 'OPEN' && 
            <Grid item lg={6} md={6} sm={12} xs={12}>
              <ThemeProvider theme={theme}>
                <Button
                  size="small"
                  style={styles.payButton}
                  variant="contained"
                  color="primary"
                  disabled={loading}
                  onClick={() => handleStatusChange('pay')}
                >
                  Pagar
                </Button>
                <Button
                  size="small"
                  style={styles.saveButton}
                  variant="contained"
                  color="secondary"
                  disabled={loading}
                  onClick={() => handleStatusChange('cancel')}
                  >
                  Cancelar
                </Button>
              </ThemeProvider>
            </Grid>
            }
          </Grid>
        }
        <Divider />
        <div style={styles.buttons}>
          <Link to="/pedidos">
            <Button variant="contained">Voltar</Button>
          </Link>

          <Button
            style={styles.saveButton}
            variant="contained"
            type="submit"
            color="primary"
            disabled={loading}
          >
            Salvar
          </Button>
        </div>
      </form>
    </PageBase>
  );
};

export default OrderForm;
