import Vue from 'vue'
import { createPinia, PiniaVuePlugin } from 'pinia'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '@scss/main.scss'

import './libs/toastification.js'

const pinia = createPinia()

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(PiniaVuePlugin)
Vue.use(VueRouter)

Vue.filter('toCurrency', function (value) {
    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });
    return formatter.format(value);
});


Vue.filter('toRate', function (value) {
    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'percent',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
    return formatter.format(parseFloat(value)/100);
});

new Vue({
    pinia,
    router,
    render: (h) => h(App)
}).$mount('#app')
