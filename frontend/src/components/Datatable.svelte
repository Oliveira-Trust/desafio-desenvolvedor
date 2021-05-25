<script>
  import { browser } from '$app/env';
  import {
    PlusIcon,
    EditIcon,
    Trash2Icon,
    CheckSquareIcon
  } from 'svelte-feather-icons';
  import { onMount, onDestroy } from 'svelte';
  import {
    Button,
    Modal,
    ModalBody,
    ModalFooter,
    FormGroup,
    Input,
    Label,
    Alert,
    Spinner,
    InputGroup,
    InputGroupText
  } from 'sveltestrap';
  import { MaskedInput } from 'svelte-imask';
  import { API_URL, numericFilter, unformatDate } from '../utils.js';
  import axios from 'axios';
  import qs from 'qs';

  export let rows = [],
             title,
             add,
             edit,
             endpoint,
             headers,
             body,
             fields,
             focus = 0,
             clients,
             items;

  let isModalOpen = false,
      editing = false,
      editingRow = [],
      alerts = [],
      modalForm = [],
      modalLoading = false,
      selectedItem,
      itemsList = [];

  const toggleModal = (open = 0, id = 0) => {
    if (id && open) {
      editing = true;
      editingRow = rows.find(x => x.id == id);

      for (const key in editingRow) {
        modalForm[key] = editingRow[key];
      }
      modalForm = modalForm;

      if (editingRow.hasOwnProperty('items')) itemsList = JSON.parse(editingRow.items);
    } else {
      editing = false;
      modalForm = [];
      itemsList = [];
    }
    
    isModalOpen = !isModalOpen;
    
    setTimeout(() => {
      jQuery('.modal input:not(.form-control)').addClass('form-control');
    }, 50);
  };

  const deleteRow = () => {
    event.path.forEach(el => {
      if (el.hasAttribute('data-id')) {
        el.classList.add('disabled-row');

        const api = axios.create(apiConfig);
        api.delete(`${endpoint}/${el.dataset.id}`).then(resp => {
          alerts.push({
            'message': 'Registro apagado com sucesso!',
            'color': 'success'
          });
          alerts = alerts;
        
          jQuery('#datatable').DataTable()
            .row(jQuery(el))
            .remove()
            .draw();
        })
        .catch(error => {
          alerts.push({
            'message': error.response.data.error_description,
            'color': 'danger'
          });
          alerts = alerts;
          console.log(error.response);

          el.classList.remove('disabled-row');
        });

        return;
      }
    });
  }

  let apiConfig = {};
  if (browser) {
    apiConfig = {
      baseURL: `${API_URL}/`,
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    };
  }

  const handleForm = () => {
    const api = axios.create(apiConfig);
    const params = modalForm;
    let apiRequest;

    if (params.document) params.document = numericFilter(params.document);
    if (params.phone) params.phone = numericFilter(params.phone);
    if (params.birthday) params.phone = unformatDate(params.birthday);
    if (itemsList) params.items = JSON.stringify(itemsList);

    console.log(params);

    if (editing) {
      apiRequest = api.put(`${endpoint}/${editingRow.id}`, qs.stringify(params));
    } else {
      apiRequest = api.post(endpoint, qs.stringify(params));
    }

    modalLoading = true;

    apiRequest.then(resp => {
      alerts.push({
        'message': editing ? 'Registro atualizado com sucesso!' : 'Registro cadastrado com sucesso!',
        'color': 'success'
      });
      alerts = alerts;

      // margem pra melhoria
      setTimeout(() => {
        location.reload();
      }, 1000);
    })
    .catch(error => {
      const data = error.response.data;
      let msg;

      if (data.hasOwnProperty('error_description')) {
        msg = data.error_description;
      } else if (data.hasOwnProperty('messages')) {
        msg = Object.values(data.messages)[0];
      } else {
        msg = `Erro ${data.error}`;
      }

      alerts.push({
        'message': msg,
        'color': 'danger'
      });
      alerts = alerts;
      console.log(error.response);
    })
    .then(() => {
      modalLoading = false;
      toggleModal();
    });
  }

  const addItem = () => {
    setTimeout(() => {
      if (selectedItem == 0) return;
      if (itemsList.filter(e => e.id === selectedItem.id).length == 0) {
        itemsList.push({
          id: selectedItem.id,
          qty: 1
        });
        itemsList = itemsList;
      }
    }, 50);
  }

  const removeItem = id => {
    itemsList = itemsList.filter(item => item.id != id);
  }

  onMount(() => {
    if (browser) {
      setTimeout(() => {
        jQuery('#datatable tfoot th:not(:last-child)').each(function() {
          const title = jQuery(this).text();
          jQuery(this).html(`<input type="text" placeholder="${title}">`);
        });

        jQuery('#datatable').DataTable({
          initComplete: function() {
            this.api().columns().every(function() {
              var that = this;
              jQuery('input', this.footer()).on('keyup change clear', function() {
                if (that.search() !== this.value) that.search(this.value).draw();
              });
            });
          },
          language: {
            decimal:        ",",
            emptyTable:     "Essa tabela está vazia. Que tal adicionar um novo registro?",
            info:           "Mostrando de _START_ a _END_ de um total de _TOTAL_ registros",
            infoEmpty:      "Mostrando de 0 a 0 de um total de 0 registros",
            infoFiltered:   "(filtrados de _MAX_ registros)",
            infoPostFix:    "",
            thousands:      ".",
            lengthMenu:     "Mostrar _MENU_ registros",
            loadingRecords: "Carregando...",
            processing:     "Processando...",
            search:         "Pesquisar:",
            zeroRecords:    "Nenhum registro encontrado",
            paginate: {
              first:        "Primeiro",
              last:         "Último",
              next:         "Próximo",
              previous:     "Anterior"
            },
            aria: {
              sortAscending:  ": ative para ordenar crescentemente",
              sortDescending: ": ative para ordenar decrescentemente"
            }
          },
          responsive: true
        });
        
        jQuery('#datatable_wrapper input').addClass('form-control form-control-sm');
        jQuery('#datatable_wrapper select').addClass('form-select form-select-sm');

        if (focus) toggleModal(true, focus);
      }, 50);
    }
  });

  onDestroy(() => {
    jQuery(`#datatable.table-${endpoint}`).DataTable().destroy();
    jQuery('#datatable_wrapper').remove();
  });
</script>

<h3 class="page-title">{title} <button class="btn btn-sm btn-success" on:click={() => { toggleModal(true) }}><PlusIcon size="24"/> {add}</button></h3>
<table id="datatable" class="table table-{endpoint}">
  <thead>
    <tr>
      {#each headers as header}
        <th>{header}</th>
      {/each}
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    {#each rows as row}
      <tr data-id="{row.id}">
        {#if body}
          {#each body as column}
            {#if column.startsWith('safe')}
              <td>{@html row[column]}</td>
            {:else}
              <td>{row[column]}</td>
            {/if}
          {/each}
        {:else}
          {#each Object.values(row) as column}
            <td>{column}</td>
          {/each}
        {/if}
        <th style="width:6rem">
          <Button color="primary" size="sm" on:click={() => { toggleModal(true, row.id) }}>
            <EditIcon size="16"/>
          </Button>
          <Button color="danger" size="sm" on:click={deleteRow}>
            <Trash2Icon size="16"/>
          </Button>
        </th>
      </tr>
    {/each}
  </tbody>
  <tfoot>
    <tr>
      {#each headers as header}
        <th>{header}</th>
      {/each}
      <th></th>
    </tr>
  </tfoot>
</table>

<Modal isOpen={isModalOpen} toggle={toggleModal} header={editing ? edit : add} class={modalLoading ? 'loading': ''}>
  <form on:submit|preventDefault={handleForm}>
    <ModalBody>
      {#each fields as field}
        <FormGroup>
          <Label class={field.required ? 'required' : ''}>{field.label}</Label>
          {#if field.type == 'string'}
            <Input type="text" name={field.name} bind:value={modalForm[field.name]} />
          {:else if field.type == 'email'}
            <Input type="email" name={field.name} bind:value={modalForm[field.name]} />
          {:else if field.type == 'money'}
            <InputGroup>
              <InputGroupText>R$</InputGroupText>
              <Input type="number" step="0.01" name={field.name} bind:value={modalForm[field.name]} />
            </InputGroup>
          {:else if field.type == 'date'}
            <MaskedInput name={field.name} bind:value={modalForm[field.name]} required={field.required} options={{ mask: '00/00/0000' }} />
          {:else if field.type == 'document'}
            <MaskedInput name={field.name} bind:value={modalForm[field.name]} required={field.required} options={{
              mask: [
                { mask: '000.000.000-00', maxLength: 11 },
                { mask: '00.000.000/0000-00' }
              ]
            }}
            />
          {:else if field.type == 'phone'}
            <MaskedInput name={field.name} bind:value={modalForm[field.name]} options={{
              mask: [
                { mask: '(00) 0000-0000', maxLength: 10 },
                { mask: '(00) 00000-0000' }
              ]
            }}
            />
          {:else if field.type == 'clients'}
            <Input type="select" name={field.name} bind:value={modalForm[field.name]} on:change={() => { console.log(modalForm[field.name]) }}>
              <option value="0">-</option>
              {#each clients as client}
                <option value={client.id}>{client.name}</option>
              {/each}
            </Input>
          {:else if field.type.startsWith('enum')}
            <Input type="select" name={field.name} bind:value={modalForm[field.name]}>
              <option value="0">-</option>
              {#each field.type.split('|')[1].split(',') as option}
                <option value={option.split(':')[0]}>{option.split(':')[1]}</option>
              {/each}
            </Input>
          {:else if field.type == 'items'}
            <Input type="select" name={field.name} bind:value={selectedItem} on:change={addItem}>
              <option value="0">Adicionar um produto...</option>
              {#each items as item}
                <option value={item}>{item.description}</option>
              {/each}
            </Input>
            <ul class="items">
              {#each itemsList as item}
                <li>{items.find(x => x.id == item.id).description} <input type="number" class="form-control form-control-sm" bind:value={item.qty}> <span on:click={() => { removeItem(item.id) }}><Trash2Icon size="16" /></span></li>
              {/each}
            </ul>
          {/if}
        </FormGroup>
      {/each}
    </ModalBody>
    <ModalFooter>
      <Button color="success"><CheckSquareIcon size="18"/> Salvar</Button>
    </ModalFooter>
  </form>
  <div class="spinner-wrapper">
    <Spinner color="primary" />
  </div>
</Modal>

<div class="alerts">
  {#each alerts as alert}
    <Alert color={alert.color} dismissible>
      {alert.message}
    </Alert>
  {/each}
</div>

<style type="text/sass">
  .spinner-wrapper
    position: absolute
    display: flex
    justify-content: center
    align-items: center
    height: 100%
    width: 100%
    background-color: rgba(255, 255, 255, .5)
    transition: all .2s ease

  ul.items,
  ul.items li
    margin: 0
    padding: 0
    text-indent: 0
    list-style-type: none

  ul.items
    margin-top: 1rem
    border: 1px solid #ced4da
    border-radius: .25rem

    &:empty
      display: none

    li
      display: flex
      align-items: center
      padding: .25rem .5rem

      &:not(:last-child)
        border-bottom: 1px solid #ced4da

      input
        width: 4rem
        margin: 0 .5rem 0 auto

      span
        display: flex
        cursor: pointer
        opacity: .75
        transition: all .2s ease

        &:hover
          opacity: 1
</style>