<template>
  <div>
    <nav-bar/>

    <div class="container">
      <b-row>
        <b-col>
          <taxas/>
        </b-col>
        <b-col>
          <formas-de-pagamento/>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import NavBar from '@/views/components/NavBar.vue'
import Taxas from '@/views/Taxas/components/Taxas/Taxas.vue'
import FormasDePagamento from '@/views/Taxas/components/FormasDePagamento/FormasDePagamento.vue'

export default {
  name: 'TaxasView',
  components: { FormasDePagamento, Taxas, NavBar },
  data() {
    return {
    }
  },
  methods: {
  },
  mounted() {
  },
}
</script>

<style scoped>

</style>
