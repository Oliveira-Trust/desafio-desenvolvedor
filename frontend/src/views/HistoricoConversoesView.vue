<template>
  <div>
    <nav-bar/>

    <div class="container">
      <div v-for="(exchange, index) in exchanges" :key="index" >
        <resultado-conversao v-model="exchanges[index]"/>
        <hr>
      </div>
      <div v-if="!exchanges.length">
        <h2>Você não tem conversões no seu histórico.</h2>
      </div>
    </div>
  </div>
</template>
<script>
import NavBar from '@/views/components/NavBar.vue'
import ResultadoConversao from '@/views/Conversor/components/ResultadoConversao.vue'
import { exchangeApi } from '@/services/api/exchangeApi.js'
import { getApiErrorMessageFromResponse } from '@/utils/index.js'
export default {
  name: 'HistoricoConversoesView',
  components: { ResultadoConversao, NavBar },
  data(){
    return {
      loading:false,
      exchanges:[]
    }
  },
  methods:{
    fetchAll(){
      this.loading = true;
      exchangeApi.index()
        .then((result) => {
          this.exchanges = result
        })
        .catch((error) => {
          console.error(error)
          const errorMessage = getApiErrorMessageFromResponse(error);
          this.$toast.error(errorMessage, { timeout: 3000 });
        })
        .finally(() => {
          this.loading_payment_methods = false
        })
    }
  },
  mounted() {
    this.fetchAll();
  }
}
</script>

<style scoped>

</style>
