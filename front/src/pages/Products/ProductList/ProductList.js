import React, { useState, useEffect }  from 'react';
import api from "../../../services/api";
import Fab from "@material-ui/core/Fab";
import AddIcon from "@material-ui/icons/Add";
import Chip from '@material-ui/core/Chip';
import DataTable from '../../../components/DataTable'
import CircularProgress from '@material-ui/core/CircularProgress';

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

export default function ProductList(props) {
    
  const [columns, setColumns] = useState([
      { title: 'Name', field: 'name' },
      { title: 'Preço', field: 'price', type: 'numeric', render: rowData => rowData.price.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) },
      { title: 'Quantidade Estoque', field: 'available_quantity', type: 'numeric' },
      { 
        title: 'Tags', 
        field: 'tags',  
        render: rowData => (
          rowData.tags.map((tag, i) => <Chip key={i} label={tag} />)
        ), 
      },
  ])
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/product')
      .then((res) => {
        let products = res.data.data
        products.forEach(product => {
          product.tags = JSON.parse(product.tags)
        })
        setData(products)
        setLoading(false)
      })
  },[])

  const handleEdit = (data) => {
    console.log('edit', data)
  }

  const handleDelete = (data) => {
    console.log('delete', data)
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
          title="Produto"
          editFunc={handleEdit}
          deleteFunc={handleDelete}
        />
      }
      <Fab 
        color="primary" 
        style={styles.fab}
        aria-label="add"
        onClick={() => props.history.push("/criar-produto")}
        title="Adicionar Produto"
      >
        <AddIcon />
      </Fab>
    </div>
  );
}