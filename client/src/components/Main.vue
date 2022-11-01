<template>
  <div class="hello">
    <h1>Conversor de moedas</h1>
    <select name="currency_to" v-model="currencyTo">
      <option disabled :value="null">Selecione uma moeda</option>
      <option v-for="(currency, key) in currencies" :value="key" :key="key">
        {{key}}: {{currency}}
      </option>
    </select>

    <select name="currency_from" v-model="currencyFrom">
      <option disabled :value="null">Selecione uma moeda</option>
      <option v-for="(currency, key) in currencies" :value="key" :key="key">
        {{key}}: {{currency}}
      </option>
    </select>

    <select name="payment_method" v-model="selectedPaymentMethod">
      <option disabled :value="null">Selecione uma forma de pagamento</option>
      <option v-for="(method, key) in paymentMethod" :value="key" :key="key">
        {{method}}
      </option>
    </select>

    <label for="value">Valor:</label>
    <input type="number" min="1000" max="100000" v-model="value">

    <button @click="getExchange()">
      Converter
    </button>
  </div>
</template>

<script>
import { getApiCurrencies, getApiExchange } from '../services/apiService';
import { useToast } from "vue-toastification";

export default {
  name: 'MainComponent',
  data: () => {
    return {
      toast: {},
      currencies: [],
      currencyTo: null,
      currencyFrom: null,
      paymentMethod: {
        credit_card: "Cartão de crédito",
        payment_slip: "Boleto"
      },
      selectedPaymentMethod: null,
      value: 1000
    }
  },
  created: async function () {
    this.toast = useToast()
    await this.getCurrencies();
  },
  methods: {
    getCurrencies: async function () {
      try {
        const data = await getApiCurrencies();
        if (data.success) {
          this.currencies = data.values
          console.log(this.currencies)
        } 
      } catch (e) {
        this.toast.error(e.message)
      }
    },
    getExchange: async function () {
      const params = {
        value: this.value,
        currency_from: this.currencyFrom,
        currency_to: this.currencyTo,
        method: this.selectedPaymentMethod
      }
      try {
        const data = await getApiExchange(params)
        console.log(data)
      } catch (e) {
        const { message } = e.response.data
        this.toast.error(message)
      }
    }
  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
