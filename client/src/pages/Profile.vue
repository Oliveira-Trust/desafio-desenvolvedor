<template>
  <div class="row">
    <div class="col-12" v-if="loading">
      <circle-spin></circle-spin>
    </div>
    <div class="col-12" v-else>
      <div v-if="!isLogged">
        <div class="col-md-6" style="display: inline-block">
          <register-form :model="modelRegister" @register="registerAccount">
          </register-form>
        </div>
        <div class="col-md-6" style="display: inline-block">
          <login-form :model="modelLogin" @login="loginAccount">
          </login-form>
        </div>
      </div>
      <div v-else>
        <base-table :title="exchangesTable.title" :sub-title="exchangesTable.subTitle" :data="exchangesTable.data"
          :columns="exchangesTable.columns">
        </base-table>
        <nav>
          <ul class="pagination">
            <li class="page-item">
              <button type="button" class="page-link" v-if="page != 1" @click="page--"> Anterior </button>
            </li>
            <li class="page-item">
              <button type="button" class="page-link" v-for="pageNumber in lastPage" @click="page = pageNumber"> {{pageNumber}} </button>
            </li>
            <li class="page-item">
              <button type="button" @click="page++" v-if="page < lastPage" class="page-link"> Proximo </button>
            </li>
          </ul>
        </nav>
      </div>
      <div v-if="errorMessage">
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
      <div class="col-12" v-if="successMessage">
        <base-alert type="info" dismissible>
          <span>{{successMessage}}</span>
        </base-alert>
      </div>
    </div>
  </div>
</template>
<script>
  import auth from '../auth.js';
  import { registerUser, loginUser, getUserExchanges } from '../services/apiService';
  import RegisterForm from './Profile/RegisterForm';
  import LoginForm from './Profile/LoginForm';
  import UserCard from './Profile/UserCard'
  import CircleSpin from '../components/Spinner/Circle.vue'
  import { BaseTable, BaseAlert } from "@/components";
  export default {
    components: {
      RegisterForm,
      LoginForm,
      UserCard,
      CircleSpin,
      BaseTable,
      BaseAlert
    },
    data() {
      return {
        isLogged: false,
        successMessage: '',
        errorMessage: '',
        loading: false,
        exchanges: null,
        modelRegister: {
          nome: '',
          email: '',
          password: '',
          confirm_password: ''
        },
        modelLogin: {
          email: '',
          password: ''
        },
        errorTable: {
          title: "Erro",
          columns: [
            "Mensagem"
          ],
          data: []
        },
        exchangesTable: {
          title: "Histórico",
          columns: [
            "Moedas",
            "Metodo de pagamento",
            "Valor",
            "Valor da moeda destino",
            "Taxa pagamento",
            "Taxa conversao",
            "Valor descontadas as taxas",
            "Valor recebido",
            "Data"
          ],
          data: []
        },
        page: 1,
        perPage: 20,
        lastPage: 1,
        pages: [],
      }
    },
    watch: {
      page: async function () {
        await this.getExchanges()
      }
    },
    created: async function () {
      this.isLogged = auth.check()
      if (this.isLogged) {
        await this.getExchanges()
      }
    },
    methods: {
      convertErrorMessageForTable(errors) {
        return Object.entries(errors).map(error => {
          return {mensagem: error[1][0]}
        })
      },
      eraseData: function () {
        this.errorMessage = ""
        this.successMessage = ""
      },
      convertExchangesForTable: function () {
        this.exchangesTable.data = []
        this.exchanges.data.map(exchange => {
          this.exchangesTable.data.push({
            "moedas": exchange.exchange_name,
            "metodo de pagamento": exchange.method,
            "valor": exchange.value,
            "valor da moeda destino": exchange.bid,
            "taxa pagamento": exchange.payment_method_rate_discount,
            "taxa conversao": exchange.conversion_rate_discount,
            "valor descontadas as taxas": exchange.discounted_value,
            "valor recebido": exchange.converted_value,
            "data": exchange.exchange_date_time
          })
        })
      },
      getExchanges: async function () {
        this.loading = true
        try {
          const response = await getUserExchanges({ page:this.page })
          this.exchanges = response.values
          this.page = this.exchanges.current_page
          this.perPage = this.exchanges.per_page
          this.lastPage = this.exchanges.last_page
          this.convertExchangesForTable()
        } catch (e) {
          const error = e.response.data
          this.errorMessage = error.message
          this.errorTable.data = this.convertErrorMessageForTable(error.errors)
        }
        this.loading = false
      },
      registerAccount: async function () {
        this.eraseData()
        try {
          this.loading = true
          const data = await registerUser(this.modelRegister)
          if (data.success) {
            this.successMessage = data.message
            auth.login(data.values.token, data.values.user)
            this.isLogged = auth.check()
            this.$router.go('profile')
          }
        } catch (e) {
          const error = e.response.data
          this.errorMessage = error.message
          this.errorTable.data = this.convertErrorMessageForTable(error.errors)
        }
        this.loading = false
      },
      loginAccount: async function () {
        this.eraseData()
        try {
          this.loading = true
          const data = await loginUser(this.modelLogin)
          if (data.success) {
            this.successMessage = data.message
            auth.login(data.values.token, data.values.user)
            this.isLogged = auth.check()
            this.$router.go('profile')
          }
        } catch (e) {
          const error = e.response.data
          this.errorMessage = error.message
          this.errorTable.data = this.convertErrorMessageForTable(error.errors)
        }
        this.loading = false
      }
    }
  }
</script>
<style>
button.page-link {
  display: inline-block;
}
button.page-link {
    font-size: 20px;
    color: #29b3ed;
    font-weight: 500;
}
.offset{
  width: 500px !important;
  margin: 20px auto;  
}
</style>
