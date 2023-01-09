<template>

  <div>
    <nav-bar/>

    <div class="container">
      <b-overlay :show="loading_payment_methods || loading_creating || loading_currencies">
        <div class="conversor_box" v-if="!resultado_conversao">

          <div class="mb-3">
            <h4 class="d-inline">Conversor de moedas</h4>
          </div>

          <b-form-group>
            <label for="origin_value" class="font-weight-bold">Valor em R$:</label>
            <b-form-input id="origin_value" type="number" v-model="origin_value"></b-form-input>
          </b-form-group>

          <b-form-group class="mt-4">
            <label class="font-weight-bold">Moeda de destino:</label>
            <b-form-select v-model="destination_currency_id" :options="currenciesAvailableToBuy"></b-form-select>
          </b-form-group>

          <b-form-group class="mt-4">
            <label class="font-weight-bold">Forma de pagamento:</label>
            <b-form-select v-model="payment_method_id" :options="paymentMethodsData"></b-form-select>
          </b-form-group>


          <b-button variant="primary" class="w-100" @click="processarConversao()">
            Converter
          </b-button>
        </div>

        <div class="conversor_box" v-else>
          <resultado-conversao v-model="resultado_conversao"/>

          <b-button variant="secondary" class="w-100" @click="resultado_conversao=null;clearInputFields()">
            Realizar nova conversao
          </b-button>

        </div>

      </b-overlay>
    </div>
  </div>
</template>

<script>
import NavBar from '@/views/components/NavBar.vue'
import { paymentMethodsApi } from '@/services/api/paymentMethodsApi.js'
import { currencyApi } from '@/services/api/currencyApi.js'
import { exchangeApi } from '@/services/api/exchangeApi.js'
import ResultadoConversao from '@/views/Conversor/components/ResultadoConversao.vue'
import { getApiErrorMessageFromResponse } from '@/utils/index.js'

export default {
  name: 'ConversorView',
  components: { ResultadoConversao, NavBar },
  data() {
    return {
      resultado_conversao: null,
      loading_payment_methods: false,
      loading_currencies: false,
      loading_creating: false,

      destination_currency_id: null,
      origin_value: null,
      payment_method_id: null,

      payment_methods: [],

      currencies: []
    }
  },
  computed: {
    paymentMethodsData() {
      return this.payment_methods.map(payment_method => ({ value: payment_method.id, text: payment_method.name }))
    },
    currenciesAvailableToBuy() {
      return this.currencies.filter((currency) => currency.available_to_buy).map(currency => ({
        value: currency.id,
        text: currency.name
      }))
    }
  },
  methods: {
    clearInputFields() {
      this.origin_value = null
      this.payment_method_id = null
      this.destination_currency_id = null
    },
    processarConversao() {
      this.loading_creating = true
      exchangeApi.create({
        origin_value: this.origin_value,
        payment_method_id: this.payment_method_id,
        destination_currency_id: this.destination_currency_id
      }).then((result) => {
          this.$toast.success('Conversão concluída com sucesso.')
          this.resultado_conversao = result
          this.clearInputFields()
        })
        .catch((error) => {
          console.error(error)
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => this.loading_creating = false)
    },
    fetchPaymentMethods() {
      this.loading_payment_methods = true
      paymentMethodsApi.index()
        .then((result) => {
          this.payment_methods = result
        })
        .catch((error) => {
          console.error(error)
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => {
          this.loading_payment_methods = false
        })
    },
    fetchCurrencies() {
      this.loading_currencies = true
      currencyApi.index()
        .then((result) => {
          this.currencies = result
        })
        .catch((error) => {
          console.error(error)
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => {
          this.loading_currencies = false
        })
    }
  },
  mounted() {
    this.fetchPaymentMethods()
    this.fetchCurrencies()
  }
}
</script>

<style scoped>
.conversor_box {
  width: 600px;
  border: 2px solid #737373;
  box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  margin: auto;
  min-height: 200px;
  padding: 1rem 1.5rem;
}
</style>
