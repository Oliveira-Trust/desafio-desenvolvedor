require('./bootstrap');

import Vue from 'vue'


import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);

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


// components
Vue.component('clientes-index', require('./components/admin/clientes/ClientesIndex.vue').default);
Vue.component('clientes-form', require('./components/admin/clientes/ClientesForm.vue').default);



// Directives
Vue.directive('format-date', {
	inserted: function (el, options) {
		let pattern = ''
		let format = 'DD/MM/YYYY'

		if (typeof options.value === 'object') {
			pattern = options.value.pattern || pattern
			format = options.value.format || format
		} else {
			format = options.value || format
		}

		if(dayjs(el.innerHTML).format() != 'Invalid Date'){
			el.innerHTML = dayjs(el.innerHTML).format(format)
		} else {
			el.innerHTML = '-'
		}
	}
})



const app = new Vue({
    el: '#app',
});