import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import InputMask from 'react-input-mask'
import { MuiPickersUtilsProvider, KeyboardDatePicker } from '@material-ui/pickers';
import Divider from "@material-ui/core/Divider";
import FormControl from "@material-ui/core/FormControl";
import PageBase from "../../../components/PageBase";
import styles from "./styles";
import DateFnsUtils from '@date-io/date-fns';
import moment from 'moment'
import { useDispatch } from "react-redux";
import api from "../../../services/api";

const ClientForm = (props) => {
  const dispatch = useDispatch()
  const [selectedDate, setSelectedDate] = useState(null)
  const [documentInput, setDocumentInput] = useState('')
  
  const [editMode, setEditMode] = useState(false)
  
  const [client, setClient] = useState({
    name: '',
    email: '',
    document:'',
    birth: null
  })
  const [loading, setLoading] = useState(false)

  useEffect(() => {
    if (props.match.params.client) {
      setEditMode(true)
      api.get(`/client/${props.match.params.client}`)
        .then((res) => {
          let editClient = res.data.data
          setSelectedDate(moment(editClient.birth))
          setDocumentInput(editClient.document)
          setClient(editClient)
        })
    }
  },[])

  const handleDateChange = (date) => {
    setSelectedDate(date)
  }

  const handleSubmit = (event) => {
    event.preventDefault()
    setLoading(true)
    client.document =  documentInput.replace(/[^\d]/g, "")
    client.birth = moment(selectedDate).format('YYYY-MM-DD')
    if (editMode) {
      api.patch(`/client/${client.id}`, client)
      .then((res) => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Cliente ${res.data.data.name} alterado com sucesso`})
          props.history.push('/clientes')
        })
    } else {
      api.post('/client', client)
      .then((res) => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Cliente ${res.data.data.name} criado com sucesso`})
          props.history.push('/clientes')
        })
    }
  }

  return (
    <PageBase title={editMode ? "Editar cliente" : "Novo Cliente"}>
      <form autoComplete="off" onSubmit={handleSubmit}>
        {/* Name */}
        <TextField
          label="Nome"
          fullWidth={true}
          margin="normal"
          value={client.name}
          required
          onChange={(e) => setClient({...client, name: e.target.value})}
        />
        {/* Email */}
        <TextField
          label="E-mail"
          type="email"
          fullWidth={true}
          margin="normal"
          value={client.email}
          required
          onChange={(e) => setClient({...client, email: e.target.value})}
        />

        <FormControl>
          {/* Document */}
          <InputMask
            mask="99.999.999-9"
            value={documentInput}
            onChange={(e) => setDocumentInput(e.target.value)}
          >
            {() => <TextField
              label="Documento"
              name="document"
              margin="normal"
              required
              type="text"
              />}
          </InputMask>
          {/* Birth */}
          <MuiPickersUtilsProvider utils={DateFnsUtils}>
            <KeyboardDatePicker
              disableToolbar
              variant="inline"
              format="dd/MM/yyyy"
              margin="normal"
              id="date-picker-inline"
              label="Data de Nascimento"
              value={selectedDate}
              required
              onChange={handleDateChange}
              KeyboardButtonProps={{
                'aria-label': 'change date',
              }}
            />
          </MuiPickersUtilsProvider>
        </FormControl>

        <Divider />

        <div style={styles.buttons}>
          <Button variant="contained" onClick={() => props.history.goBack()}>Voltar</Button>

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

export default ClientForm;
