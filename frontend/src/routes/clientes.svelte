<script>
  import axios from 'axios';
  import { browser } from '$app/env';
  import Datatable from '../components/Datatable.svelte';
  import DatatableSpinner from '../components/DatatableSpinner.svelte';
  import { API_URL, formatDocument, formatDate, formatPhone, GET } from '../utils.js';

  let rows;

  if (browser) {
    axios.get(`${API_URL}/clients`, { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }).then(resp => {
      let data = resp.data;
      rows = data.map(row => {
        if (row.document) row.document = formatDocument(row.document);
        if (row.birthday) row.birthday = formatDate(row.birthday);
        if (row.phone) row.phone = formatPhone(row.phone);
        return row;
      });
    })
    .catch(error => {
      console.log(error.response);
    });
  }

  let focus = 0;
  if (GET('id')) focus = GET('id');
</script>

{#if rows}
  <Datatable
    {rows}
    endpoint="clients"
    title="Clientes"
    add="Novo cliente"
    edit="Editar cliente"
    headers={[
      '#',
      'Nome',
      'CPF/CNPJ',
      'E-mail',
      'Data de nascimento',
      'Telefone'
    ]}
    fields={[
      { name: 'name',     type: 'string',   required: 1, label: 'Nome'               },
      { name: 'document', type: 'document', required: 1, label: 'CPF/CNPJ'           },
      { name: 'email',    type: 'email',    required: 0, label: 'E-mail'             },
      { name: 'birthday', type: 'date',     required: 0, label: 'Data de nascimento' },
      { name: 'phone',    type: 'phone',    required: 0, label: 'Telefone'           }
    ]}
    {focus}
    />
{:else}
  <DatatableSpinner/>
{/if}