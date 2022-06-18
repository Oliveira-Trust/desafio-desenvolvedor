import {createApp} from "vue";
import {store} from "./store";

const user = localStorage.getItem('user');
if (user) {
    store.commit('setUser', JSON.parse(user));
}

import router from "./router";

import App from './App.vue'

const app = createApp(App)
    .use(store)
    .use(router);

app.mount("#app");
