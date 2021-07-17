require('./bootstrap');

import Vue from 'vue'


// to use mask in fields
import mask from 'vue-the-mask'
Vue.use(mask)

// https://github.com/kevinongko/vue-numeric
import VueNumeric from 'vue-numeric'
Vue.use(VueNumeric)

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

Vue.component('pagination', require('laravel-vue-pagination'));



import vSelect from "vue-select";
Vue.component("v-select", vSelect);


// https://day.js.org/docs/en/installation/node-js
var dayjs = require('dayjs')
Vue.component('dayjs', require('dayjs'));


// components
Vue.component('clientes-index', require('./components/admin/clientes/ClientesIndex.vue').default);
Vue.component('clientes-form', require('./components/admin/clientes/ClientesForm.vue').default);
Vue.component('categorias-index', require('./components/admin/categorias/CategoriasIndex.vue').default);
Vue.component('categorias-form', require('./components/admin/categorias/CategoriasForm.vue').default);
Vue.component('produtos-index', require('./components/admin/produtos/ProdutosIndex.vue').default);
Vue.component('produtos-form', require('./components/admin/produtos/ProdutosForm.vue').default);
Vue.component('pedidos-index', require('./components/admin/pedidos/PedidosIndex.vue').default);
Vue.component('pedidos-form', require('./components/admin/pedidos/PedidosForm.vue').default);
Vue.component('pedidos-show', require('./components/admin/pedidos/PedidosShow.vue').default);

// micro components
Vue.component('delete-in-mass', require('./components/parts/DeleteInMass.vue').default);
Vue.component('sort-items', require('./components/parts/SortItems.vue').default);
Vue.component('admin-filter', require('./components/parts/AdminFilter.vue').default);




const app = new Vue({
    el: '#app',
});