import "./bootstrap";
import { createApp } from "vue";
import App from "./components/App.vue";
import Router from "./router/index.js";
import { createPinia } from "pinia";
import { VueClipboard } from "@soerenmartius/vue3-clipboard";

createApp(App).use(Router).use(createPinia()).use(VueClipboard).mount("#app");
