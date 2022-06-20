import {createApp} from "vue";
import {store} from "./store";

const user = localStorage.getItem('user');
if (user) {
    store.commit('setUser', JSON.parse(user));
}

import axios from "./services/axios";
import router from "./router";

import App from './App.vue'

const app = createApp(App)
    .use(store)
    .use(router);
app.config.globalProperties.axios = axios

app.mount("#app");
