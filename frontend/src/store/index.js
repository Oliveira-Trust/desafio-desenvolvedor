import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    isSideMenuVisible: false,
    usuario: null
  },
  mutations: {
    toggleMenu (state, isVisible) {
      if (!state.usuario) {
        state.isSideMenuVisible = false
        return
      }

      if (isVisible === undefined) {
        state.isSideMenuVisible = !state.isSideMenuVisible
      } else {
        state.isSideMenuVisible = isVisible
      }
    },
    setUsuario (state, usuario) {
      state.usuario = usuario.usuario
      if (usuario) {
        axios.defaults.headers.Authorization = `Bearer ${usuario.token}`
        state.isSideMenuVisible = true
      } else {
        delete axios.defaults.headers.common.Authorization
        state.isSideMenuVisible = false
      }
    }
  },
  actions: {
  },
  modules: {
  }
})
