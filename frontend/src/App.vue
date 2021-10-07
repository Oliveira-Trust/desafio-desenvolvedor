<template>
  <div
    id="app"
    :class="{'hide-menu': !isSideMenuVisible || !usuario}"
  >
    <Header
      title="Conversor de Moedas"
      :hide-toggle="!usuario"
      :hide-user-dropdown="!usuario"
    />
    <SideMenu v-if="usuario" />
    <Loading v-if="validatingToken" />
    <Content v-else />
    <Footer />
  </div>
</template>
<script>
// import axios from 'axios'
// import { baseApiUrl, userKey } from '@/config/global'
import { mapState } from 'vuex'
import Header from '@/components/template/Header'
import SideMenu from '@/components/template/SideMenu'
import Content from '@/components/template/Content'
import Footer from '@/components/template/Footer'
import Loading from '@/components/template/Loading'

export default {
  name: 'App',
  components: { Header, SideMenu, Content, Footer, Loading },

  data () {
    return {
      validatingToken: false
    }
  },
  computed: mapState(['isSideMenuVisible', 'usuario']),
  created () {
    this.validateToken()
  },
  methods: {
    async validateToken () {
      /* this.validatingToken = true
      const json = localStorage.getItem(userKey)
      const userData = JSON.parse(json)
      this.$store.commit('setUsuario', null)

      if (!userData) {
        this.validatingToken = false
        this.$router.push({ name: 'login' })
        return
      }

      const res = await axios.post(`${baseApiUrl}/validateToken`, userData)

      if (res.data) {
        this.$store.commit('setUsuario', userData)
        if (this.$mq === 'xs' || this.$mq === 'sm') {
          this.$store.commit('toggleMenu', false)
        }
      } else {
        localStorage.removeItem(userKey)
        this.$router.push({ name: 'login' })
      }
      */
      this.validatingToken = false
    }
  },

}
</script>
<style>
* {
    font-family: 'Lato', sans-serif
  }
  body {
    margin: 0;
  }
  #app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

    height: 100vh;
    display: grid;
    grid-template-rows: 60px 1fr 40px;
    grid-template-columns: 300px 1fr;
    grid-template-areas:
          "header header"
          "sideMenu content"
          "sideMenu footer"
  }
  #app.hide-menu
  {
       grid-template-areas:
          "header header"
          "content content"
          "footer footer"
  }
</style>
