import {createApp} from 'vue';

require('./bootstrap');
import App from './App.vue'
import axios from 'axios';
import router from './router'
import money from 'v-money3';

require('vue');

const app = createApp(App);

app.use(router);
app.use(money);
app.config.globalProperties.$axios = axios;
app.mount('#app');
