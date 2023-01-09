<template>
  <div>
    <b-overlay :show="loading">

      <div class="d-flex justify-content-between">
          <h4 class="d-inline">Taxas por valor</h4>
          <button class="btn btn-sm btn-dark" @click="openCreateModal()">+ Taxa</button>
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

        <template #cell(starting_value)="data">
          <div class="text-right">{{ data.item.starting_value  | toCurrency }}</div>
        </template>

        <template #cell(actions)="data">
          <div class="d-flex justify-content-around">
            <button class="btn btn-sm btn-dark mr-1" @click="openEditModal(data.item)">Editar</button>
            <button class="btn btn-sm btn-dark" @click="destroyFee(data.item.id)">
              <b-icon icon="trash"></b-icon>
            </button>
          </div>
        </template>

      </b-table>
    </b-overlay>

    <modal-editar-taxa ref="modal_edit" @saved="fetchFees"/>
    <modal-create-taxa ref="modal_create" @saved="fetchFees"/>
  </div>
</template>

<script>
import ModalEditarTaxa from '@/views/Taxas/components/Taxas/ModalEditarTaxa.vue'
import ModalCreateTaxa from '@/views/Taxas/components/Taxas/ModalCreateTaxa.vue'
import { feeApi } from '@/services/api/feeApi.js'
import { getApiErrorMessageFromResponse } from '@/utils/index.js'

export default {
  name: 'Taxas',
  components: { ModalCreateTaxa, ModalEditarTaxa },
  data() {
    return {
      loading: false,
      items: [],
      fields: [
        {
          key: 'starting_value',
          label: 'Valor inicial',
          thStyle: { textAlign: 'right' },
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
    openCreateModal(){
      this.$refs.modal_create.open();
    },
    openEditModal(data){
      this.$refs.modal_edit.open(data);
    },
    fetchFees() {
      this.loading = true
      feeApi.index()
        .then((result) => {
          console.log(result)
          this.items = result
        })
        .catch((error) => {
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => {
          this.loading = false
        })

    },
    destroyFee(id) {
      this.loading = true
      feeApi.destroy(id)
        .then(() => {
          this.$toast("Registro removido com sucesso.");
          this.fetchFees();
        })
        .catch((error) => {
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => {
          this.loading = false
        })

    }
  },
  mounted() {
    this.fetchFees()
  },
}
</script>

<style scoped>

</style>
