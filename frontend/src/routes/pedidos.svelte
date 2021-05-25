<script>
  import axios from 'axios';
  import { browser } from '$app/env';
  import Datatable from '../components/Datatable.svelte';
  import DatatableSpinner from '../components/DatatableSpinner.svelte';
  import { API_URL, formatMoney } from '../utils.js';

  let rows, clients, items;

  if (browser) {
    const api = axios.create({
      baseURL: `${API_URL}/`,
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    });

    api.get('orders').then(resp => {
      let data = resp.data;
      rows = data.map(row => {
        if (row.value) row.formattedValue = formatMoney(row.value);
        if (row.client) row.safeClient = `<a href="${window.location.origin}/clientes?id=${row.client.id}">${row.client.name}</a>`;
        if (row.status) {
          let color, text;
          switch (row.status) {
            case 'pending':
              text = 'Em aberto';
              color = 'warning';
              break;
            case 'paid':
              text = 'Pago';
              color = 'success';
              break;
            case 'canceled':
              text = 'Cancelado';
              color = 'dark';
              break;
          }
          row.safeStatus = `<span class="badge bg-${color}">${text}</span>`;
        }
        return row;
      });
    })
    .catch(error => {
      console.log(error.response);
    });

    api.get('clients').then(resp => {
      let data = resp.data;
      data.sort((a, b) => a.name.localeCompare(b.name));
      clients = data;
    })
    .catch(error => {
      console.log(error.response);
    });

    api.get('items').then(resp => {
      let data = resp.data;
      data.sort((a, b) => a.name.localeCompare(b.name));
      items = data;
    })
    .catch(error => {
      console.log(error.response);
    });
  }
</script>

{#if rows}
  <Datatable
    {rows}
    {clients}
    {items}
    endpoint="orders"
    title="Pedidos"
    add="Novo pedido"
    edit="Editar pedido"
    headers={[
      '#',
      'Cliente',
      'Valor',
      'Status'
    ]}
    body={[
      'id',
      'safeClient',
      'formattedValue',
      'safeStatus'
    ]}
    fields={[
      { name: 'client_id', type: 'clients',                                             required: 1, label: 'Cliente' },
      { name: 'status',    type: 'enum|pending:Em aberto,paid:Pago,canceled:Cancelado', required: 1, label: 'Status'  },
      { name: 'items',     type: 'items',                                               required: 1, label: 'Itens'   }
    ]}
    />
{:else}
  <DatatableSpinner/>
{/if}