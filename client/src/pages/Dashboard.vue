<template>
  <div>
    <div class="row">
      <div class="col-12" v-if="currenciesLoading">
        <circle-spin></circle-spin>
      </div>
      <div class="col-12" v-else>
        <h1>Conversor de moedas</h1>

        <select name="currency_from" v-model="currencyFrom">
          <option disabled :value="null">Selecione uma moeda</option>
          <option v-for="(currency, key) in currencies" :value="key" :key="key">
            {{key}}: {{currency}}
          </option>
        </select>

        <select name="currency_to" v-model="currencyTo">
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

        <div class="col-12" v-if="errorMessage">
          <base-alert type="danger" dismissible>
            <span>{{errorMessage}}</span>
          </base-alert>
          <card class="card-plain">
            <div class="table-full-width table-responsive">
              <base-table :title="errorTable.title" :sub-title="errorTable.subTitle" :data="errorTable.data"
                :columns="errorTable.columns">
              </base-table>
            </div>
          </card>
        </div>

        <div class="col-12" v-if="simulatedResult">
          <base-alert type="info" dismissible>
            <span>{{successMessage}}</span>
          </base-alert>
          <div>
            <p><strong>Valor usado para conversão</strong> ${{simulatedResult.bid}}</p>
            <p><strong>Taxa de pagamento</strong> ${{simulatedResult.payment_method_rate_discount}}</p>
            <p><strong>Taxa de conversão</strong> ${{simulatedResult.conversion_rate_discount}}</p>
            <p><strong>Valor utilizado para conversão descontando as taxas</strong> ${{simulatedResult.discounted_value}}</p>
            <p><strong>Valor comprado</strong> ${{simulatedResult.converted_value}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { getApiCurrencies, getApiExchange } from '../services/apiService';
  import CircleSpin from '../components/Spinner/Circle.vue'
  import { BaseTable, BaseAlert } from "@/components";

  export default {
    components: {
      CircleSpin,
      BaseTable,
      BaseAlert
    },
    data() {
      return {
        currenciesLoading: false,
        errorMessage: "",
        currencies: [],
        currencyFrom: 'BRL',
        currencyTo: null,
        paymentMethod: {
          credit_card: "Cartão de crédito",
          payment_slip: "Boleto"
        },
        selectedPaymentMethod: null,
        value: 1000,
        sendEmail: false,
        simulatedResult: null,
        successMessage: null,
        errorTable: {
          title: "Erro",
          columns: [
            "Mensagem"
          ],
          data: []
        }
      }
    },
    created: async function () {
      this.currenciesLoading = true;
      await this.getCurrencies();
      this.currenciesLoading = false;
    },
    computed: {
    },
    methods: {
      convertErrorMessageForTable(errors) {
        return Object.entries(errors).map(error => {
          return {mensagem: error[1][0]}
        })
      },
      getCurrencies: async function () {
        try {
          const data = await getApiCurrencies();
          if (data.success) {
            this.currencies = data.values
          } 
        } catch (e) {
          const { message } = e.response.data
          this.errorMessage = message;
        }
      },
      eraseData: function () {
        this.errorMessage = ""
        this.successMessage = ""
        this.simulatedResult = null
      },
      getExchange: async function () {
        this.eraseData()
        const params = {
          value: this.value,
          currency_from: this.currencyFrom,
          currency_to: this.currencyTo,
          method: this.selectedPaymentMethod,
          send_email: this.sendEmail
        }
        try {
          const data = await getApiExchange(params)
          if (data.success) {
            this.successMessage = data.message
            this.simulatedResult = data.values
          }
        } catch (e) {
          const error = e.response.data
          this.errorMessage = error.message
          this.errorTable.data = this.convertErrorMessageForTable(error.errors)
        }
      }
    }
  };
</script>
<style>
  
</style>
