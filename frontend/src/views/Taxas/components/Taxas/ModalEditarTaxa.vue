<template>
  <div>
    <b-modal
      id="modal_edit_taxa"
      title="Editar taxa"
      hide-header-close
      modal-body="position-static"
      static
    >

      <b-overlay :show="loading" no-wrap fixed></b-overlay>

      <label for="fee_rate">Valor inicial:</label>
      <b-form-input id="starting_value" type="number" v-if="data" v-model="data.starting_value"></b-form-input>

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

import { feeApi } from '@/services/api/feeApi.js'
import { getApiErrorMessageFromResponse } from '@/utils/index.js'

export default {
  name: 'ModalEditarTaxa',
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
      this.$bvModal.show('modal_edit_taxa')
    },
    close() {
      this.$bvModal.hide('modal_edit_taxa')
    },
    save() {
      this.loading = true
      feeApi.update(this.data.id, {
        fee_rate: this.data.fee_rate,
        starting_value: this.data.starting_value,
      })
        .then((result) => {
          this.items = result
          this.$toast.success("Registro salvo com sucesso.");
          this.close();
          this.$emit('saved',result);
        })
        .catch((error) => {
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
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
