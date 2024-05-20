import './bootstrap';
import '@mdi/font/css/materialdesignicons.css'

import ConversionCalculator from './components/Quote/ConversionCalculator.vue';
import { createApp } from 'vue'
import { createVuetify } from 'vuetify'

const app = createApp()
const vuetify = createVuetify({})

app.component('conversion-calculator', ConversionCalculator)

app.use(vuetify)

app.mount('#app')