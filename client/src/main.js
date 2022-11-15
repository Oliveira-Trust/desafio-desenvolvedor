/*
 =========================================================
 * Vue Black Dashboard - v1.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/black-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */
 import Vue from "vue";
 import VueRouter from "vue-router";
 import RouterPrefetch from 'vue-router-prefetch'
 import App from "./App";
 import router from "./router/index";
 import auth from './auth'
 import BlackDashboard from "./plugins/blackDashboard";
 import i18n from "./i18n"
 import './registerServiceWorker'
 Vue.use(BlackDashboard);
 Vue.use(VueRouter);
 Vue.use(RouterPrefetch);
 Vue.use(auth)
 
 /* eslint-disable no-new */
 new Vue({
   router,
   i18n,
   render: h => h(App)
 }).$mount("#app");
 