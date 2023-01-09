<template>
  <div>
    <b-modal
      id="modal_create_taxa"
      title="Cadastrar taxa"
      hide-header-close
      modal-body="position-static"
      static
    >

      <b-overlay :show="loading" no-wrap fixed></b-overlay>

      <label for="fee_rate">Valor inicial:</label>
      <b-form-input id="starting_value" type="number" v-model="starting_value"></b-form-input>

      <label for="fee_rate">Percentual:</label>
      <b-form-input id="fee_rate" type="number" v-model="fee_rate"></b-form-input>
      <template #modal-footer="{ ok, cancel }">
        <b-button variant="secondary" @click="close()">
          Fechar
        </b-button>
        <b-button variant="primary" @click="save()">
          Salvar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>

import { feeApi } from '@/services/api/feeApi.js'

export default {
  name: 'ModalCreateTaxa',
  data() {
    return {
      loading: false,
      starting_value: null,
      fee_rate: null,
    }
  },
  methods: {
    open(data) {
      this.data = data
      this.$bvModal.show('modal_create_taxa')
    },
    close() {
      this.$bvModal.hide('modal_create_taxa')
    },
    save() {
      this.loading = true
      feeApi.create({
        fee_rate: this.fee_rate,
        starting_value: this.starting_value,
      })
        .then((result) => {
          this.items = result
          this.$toast.success("Registro salvo com sucesso.");
          this.close();
          this.$emit('saved',result);
        })
        .catch((error) => {
          console.error(error)
          this.$toast.error(error.response?.data?.message ?? 'Ocorreu um problema, tente novamente mais tarde.', {
            timeout: 2000
          })
        })
        .finally(() => {
          this.loading = false;
        })
    }
  }
}
</script>

<style scoped>

</style>
