import './bootstrap';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import ConversionCalculator from './components/Quote/ConversionCalculator.vue';
import Historic from './components/Quote/Historic.vue';
import Config from './components/Quote/Config.vue';


import { createApp } from 'vue'
import { createVuetify } from 'vuetify'

const app = createApp()
const vuetify = createVuetify({
    components,
    directives
})

app.component('conversion-calculator', ConversionCalculator)
app.component('historic-cotations', Historic)
app.component('config-tax', Config)

app.use(vuetify)

app.mount('#app')