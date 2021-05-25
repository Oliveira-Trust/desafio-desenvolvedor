<script>
  import axios from 'axios';
  import { browser } from '$app/env';
  import Datatable from '../components/Datatable.svelte';
  import DatatableSpinner from '../components/DatatableSpinner.svelte';
  import { API_URL, formatMoney } from '../utils.js';

  let rows;

  if (browser) {
    axios.get(`${API_URL}/items`, { headers: { Authorization: `Bearer ${localStorage.getItem('token')}` } }).then(resp => {
      let data = resp.data;
      rows = data.map(row => {
        if (row.cost_price) row.formattedCostPrice = formatMoney(row.cost_price);
        if (row.retail_price) row.formattedRetailPrice = formatMoney(row.retail_price);
        return row;
      });
    })
    .catch(error => {
      console.log(error.response);
    });
  }
</script>

{#if rows}
  <Datatable
    {rows}
    endpoint="items"
    title="Produtos"
    add="Novo produto"
    edit="Editar produto"
    headers={[
      '#',
      'Descrição',
      'Preço de custo',
      'Preço de venda',
    ]}
    body={[
      'id',
      'description',
      'formattedCostPrice',
      'formattedRetailPrice'
    ]}
    fields={[
      { name: 'description',  type: 'string', required: 1, label: 'Descrição'      },
      { name: 'cost_price',   type: 'money',  required: 1, label: 'Preço de custo' },
      { name: 'retail_price', type: 'money',  required: 1, label: 'Preço de venda' }
    ]}
    />
{:else}
  <DatatableSpinner/>
{/if}