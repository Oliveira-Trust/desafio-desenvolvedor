import {createApp} from 'vue';

// import "primeflex/primeflex.css";
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";

require('./bootstrap');
import App from './App.vue'
import axios from 'axios';
import router from './router'
import money from 'v-money3';
import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

require('vue');

const app = createApp(App);

app.use(router);
app.use(money);
app.use(PrimeVue, {ripple: true});

app.component('DataTable', DataTable);
app.component('Column', Column);

app.config.globalProperties.$axios = axios;
app.mount('#app');
