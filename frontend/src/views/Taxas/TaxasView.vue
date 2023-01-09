<template>
  <div>
    <nav-bar/>

    <div class="container">
      <b-row>
        <b-col>
          <taxas/>
        </b-col>
        <b-col>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
import NavBar from '@/views/components/NavBar.vue'
import Taxas from '@/views/Taxas/components/Taxas.vue'

export default {
  name: 'TaxasView',
  components: { Taxas, NavBar },
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
