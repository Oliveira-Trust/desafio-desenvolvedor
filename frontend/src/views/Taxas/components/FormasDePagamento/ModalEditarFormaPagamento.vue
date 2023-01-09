<template>
  <div>
    <b-modal
      id="modal_edit_forma_pagamento"
      title="Editar taxa"
      hide-header-close
      modal-body="position-static"
      static
    >

      <b-overlay :show="loading" no-wrap fixed></b-overlay>

      <label for="fee_rate">Percentual:</label>
      <b-form-input id="fee_rate" type="number" v-if="data" v-model="data.fee_rate"></b-form-input>

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

import { paymentMethodsApi } from '@/services/api/paymentMethodsApi.js'

export default {
  name: 'ModalEditarFormaPagamento',
  data() {
    return {
      loading: false,
      data: null,
    }
  },
  methods: {
    open(data) {
      this.data = {
        ...data
      }
      this.$bvModal.show('modal_edit_forma_pagamento')
    },
    close() {
      this.$bvModal.hide('modal_edit_forma_pagamento')
    },
    save() {
      this.loading = true
      paymentMethodsApi.update(this.data.id, {
        fee_rate: this.data.fee_rate,
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
