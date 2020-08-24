import axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isMenuVisible: false,
        user: null
    },
    mutations: {
        toggleMenu(state, isVisible) {
            if(!state.user) {
                state.isMenuVisible = false
                return
            }

            if(isVisible === undefined) {
                state.isMenuVisible = !state.isMenuVisible
            } else {
                state.isMenuVisible = isVisible
            }
        },
        setUser(state, user) {
            state.user = user
            if(user) {
                axios.defaults.headers.common['Authorization'] = `bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiYjY0MDE3NzZiNzQ3ODFlOTdiMzE3NzIxYWZmZjNlNmYyODYxYWIzMWEzNTg2ZTg4NWYzNGYxNzVlYjFkOGQ0MGU1NGRhM2FlOGExYzk3NjciLCJpYXQiOjE1OTgxNTYyNjIsIm5iZiI6MTU5ODE1NjI2MiwiZXhwIjoxNjI5NjkyMjYyLCJzdWIiOiIzOSIsInNjb3BlcyI6W119.mqkm3empY9YEIqWd-cf7kdmg9Homw3awlAaq3jL9K-1jaUDDRomC0nmEVPlp2oj3ngwzgyyiLWfdqUAoo5NGK-neAmAbLLyWShtZ5jhKSz1nXyW_ASBewEXnNnXU-UPN9tffVGuBH9h9I1iCuFkNw4VW5ckwyU5ByGREf4v-piBX1HNveWgcmIpm9zkeTQsSWhSCUR2LVHiyGzdllrlFj8Q8ozVVgaYsauglef03NMhW3X6dz8fjieOgz33m_QCI9dne0EZGM7m3WmGUMcc8m6POovggGL9sVhCRIZ4orrUXFaDr9tLqyzxL3GeIm4rfdHV9VrDYDHYsqVp-8rXr4g2pZ1W2gtYyy0lwbZ3_xh2shTxUmeooZUlaw2X21ils9XgMtg5t237q_hrWWH3HV73hBCRZk2PnOsJK3erSflFQlYPK6YIX6T5AG3EEt3xu8AJ52UNdIzt33mKbKPGFCdZn5t5PRSjh3WY_8Z1MeuAa49rUQ2Pux5Q9ApbIWEeNe6GYo33oFXdLci98wEn4C5n7T5J78GUXWf_i2qzbGGsTKEsbx_dq3YIknDNaczq7xXohwiIxKS0ZQODAopZ_NJZUNcyjmWMuSpvxB4bghWXWo0q-lRfvtkGEyj9Ygj8sfkiFhPUuv91XO_OMqY2JdPtVxvMR8LdZxQeroDmK1Dg`
                state.isMenuVisible = true
            } else {
                delete axios.defaults.headers.common['Authorization']
                state.isMenuVisible = false
            }
        }
    }
})