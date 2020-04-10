import React, { forwardRef, useState, useEffect }  from 'react';
import MaterialTable from 'material-table';
import api from "../../../services/api";
import Fab from "@material-ui/core/Fab";
import AddIcon from "@material-ui/icons/Add";
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

export default function ClientList(props) {

  const [columns, setColumns] = useState([
      { title: 'Name', field: 'name' },
      { title: 'E-mail', field: 'email' },
      { title: 'Documento', field: 'document', type: 'numeric' },
      { title: 'Data de nascimento', field: 'birth' },
  ])

  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.get('/client')
      .then((res) => {
        let clients = res.data.data
        clients.forEach(client => {
          const d = new Date(client.birth)
          client.birth = `${d.getDate()+1}/${d.getMonth()+1}/${d.getFullYear()}`
        })
        setData(clients)
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
          title="Cliente"
          editFunc={handleEdit}
          deleteFunc={handleDelete}
        />
      }
      <Fab 
        color="primary" 
        style={styles.fab} 
        aria-label="add"
        onClick={() => props.history.push("/criar-cliente")}
        title="Adicionar Cliente"
      >
        <AddIcon />
      </Fab>
    </div>
  );
}