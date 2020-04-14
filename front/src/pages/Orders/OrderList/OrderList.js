import React, { useState, useEffect }  from 'react';
import api from "../../../services/api";
import Fab from "@material-ui/core/Fab";
import AddIcon from "@material-ui/icons/Add";
import DataTable from '../../../components/DataTable'
import CircularProgress from '@material-ui/core/CircularProgress';
import { useDispatch } from "react-redux";
import moment from 'moment';
import translateStatus from '../helpers'

const styles = {
  fab: {
    margin: 0,
    top: "auto",
    right: 20,
    bottom: 20,
    left: "auto",
    position: "fixed",
  }
};

export default function OrderList(props) {
  const dispatch = useDispatch()

  const [columns, setColumns] = useState([
      { title: 'Status', field: 'status' },
      { title: 'Cliente', field: 'client', render: rowData => rowData.client.name },
      { title: 'Produto', field: 'product', render: rowData => rowData.product.name },
      { title: 'Quantidade', field: 'quantity_ordered', type: 'numeric' },
      { title: 'Total', field: 'total', type: 'numeric', render: rowData => rowData.total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})},
      { title: 'Data', field: 'created_at', render: rowData => moment(rowData.created_at).format('D/MM/Y HH:m:s')},
  ])

  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/order')
      .then((res) => {
        let orders = res.data.data
        orders.forEach(order => {
          order.status = translateStatus(order.status)
          if (!order.total) {
            order.total = 0
          }
        })
        setData(orders)
        setLoading(false)
      })
  },[])

  const handleEdit = (editData) => {
    if (editData.length === 1) {
      props.history.push(`/editar-pedido/${editData[0].id}`)
    } else {
      dispatch({type: 'SNACKBAR_SHOW', message: 'Selecione somente um item para editar'})
    }
  }

  const handleDelete = (deleteData) => {
    let newData = data
    Promise.all(deleteData.map(async (order) => {
      await api.delete(`/order/${order.id}`)
        .then(() => {
          newData = newData.filter((item) => {
            return item.id !== order.id
          })
          setLoading(true)
        })
    }))
      .then(() => {
        setData(newData)
        setLoading(false)
        dispatch({type: 'SNACKBAR_SHOW', message: 'Pedido(s) excluído(s) com sucesso'})
      })
  }

  return (
    <div>
      {loading ?
        <div style={{textAlign: "center"}}>
          <CircularProgress
            size={50}
          />
        </div>
      :
        <DataTable
          columns={columns}
          data={data}
          title="Pedido"
          editFunc={handleEdit}
          deleteFunc={handleDelete}
        />
      }
      <Fab 
        color="primary" 
        style={styles.fab} 
        aria-label="add"
        onClick={() => props.history.push("/criar-pedido")}
        title="Adicionar Pedido"
      >
        <AddIcon />
      </Fab>
    </div>
  );
}