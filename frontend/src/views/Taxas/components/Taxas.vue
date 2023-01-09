<template>
  <div>
    <b-overlay :show="loading">
      <h4>Taxas por valor</h4>
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
          <div class="text-right">
            <button class="btn btn-sm btn-dark" @click="openEditModal(data.item)">Editar</button>
          </div>
        </template>

      </b-table>
    </b-overlay>

    <modal-editar-taxa ref="modal"/>
  </div>
</template>

<script>
import { fees } from '@/services/api/index.js'
import ModalEditarTaxa from '@/views/Taxas/components/ModalEditarTaxa.vue'

export default {
  name: 'Taxas',
  components: { ModalEditarTaxa },
  data() {
    return {
      loading: false,
      items: [],
      fields: [
        {
          key: 'actions',
          thStyle: { width: '10%', textAlign: 'right' },
          label: ''
        },
        {
          key: 'starting_value',
          label: 'Valor inicial',
          thStyle: { textAlign: 'right' },
        },
        {
          key: 'fee_rate',
          label: 'Percentual',
          thStyle: { textAlign: 'right' },
        }
      ]
    }
  },
  methods: {
    openEditModal(data){
      this.$refs.modal.open(data);
    },
    fetchFees() {
      this.loading = true
      fees()
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

    }
  },
  mounted() {
    this.fetchFees()
  },
}
</script>

<style scoped>

</style>
