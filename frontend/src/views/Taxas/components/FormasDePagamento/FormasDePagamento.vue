<template>
  <div>
    <b-overlay :show="loading">

      <div class="d-flex justify-content-between">
          <h4 class="d-inline">Formas de pagamento</h4>
      </div>

      <b-table
        class="mt-3"
        hover
        head-variant="dark"
        small
        responsive="sm"
        :fields="fields"
        :items="items"
      >


        <template #cell(fee_rate)="data">
          <div class="text-right">{{ data.item.fee_rate | toRate }}</div>
        </template>

        <template #cell(actions)="data">
          <div class="d-flex justify-content-around">
            <button class="btn btn-sm btn-dark mr-1" @click="openEditModal(data.item)">Editar</button>
          </div>
        </template>

      </b-table>
    </b-overlay>

    <modal-editar-forma-pagamento ref="modal_edit" @saved="fetchAll"/>
  </div>
</template>

<script>
import { paymentMethodsApi } from '@/services/api/paymentMethodsApi.js'
import ModalEditarFormaPagamento from '@/views/Taxas/components/FormasDePagamento/ModalEditarFormaPagamento.vue'

export default {
  name: 'FormasDePagamento',
  components: { ModalEditarFormaPagamento },
  data() {
    return {
      loading: false,
      items: [],
      fields: [
        {
          key: 'name',
          label: 'Nome',
          thStyle: { textAlign: 'left' },
        },
        {
          key: 'fee_rate',
          label: 'Percentual',
          thStyle: { textAlign: 'right' },
        },
        {
          key: 'actions',
          thStyle: { width: '120px',  textAlign: 'right' },
          label: ''
        },
      ]
    }
  },
  methods: {
    openEditModal(data){
      this.$refs.modal_edit.open(data);
    },
    fetchAll() {
      this.loading = true
      paymentMethodsApi.index()
        .then((result) => {
          console.log(result)
          this.items = result
        })
        .catch((error) => {
          console.error(error)
          this.$toast.error(error.response?.data?.message ?? 'Ocorreu um problema, tente novamente mais tarde.', {
            timeout: 2000
          })
        })
        .finally(() => {
          this.loading = false
        })

    },
  },
  mounted() {
    this.fetchAll()
  },
}
</script>

<style scoped>

</style>
