/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
{
    path: '/cotacoes-taxas/create',
    component: () => import('./pages/taxas/Form.vue'),
    name: 'cotacoes-taxas-create'
},
{
    path: '/cotacoes-taxas',
    component: () => import('./pages/taxas/Index.vue'),
    name: 'cotacoes-taxas'
},
{
    path: '/cotacoes-taxas/:id/edit',
    component: () => import('./pages/taxas/Form.vue'),
    name: 'cotacoes-taxas-edit'
},
{
    path: '/cotacoes-taxas-ranges/create',
    component: () => import('./pages/taxas-ranges/Form.vue'),
    name: 'cotacoes-taxas-ranges-create'
},
{
    path: '/cotacoes-taxas-ranges',
    component: () => import('./pages/taxas-ranges/Index.vue'),
    name: 'cotacoes-taxas-ranges'
},
{
    path: '/cotacoes-taxas-ranges/:id/edit',
    component: () => import('./pages/taxas-ranges/Form.vue'),
    name: 'cotacoes-taxas-ranges-edit'
},
{
    path: '/tipos-cobrancas/create',
    component: () => import('./pages/tipos-cobrancas/Form.vue'),
    name: 'tipos-cobrancas-create'
},
{
    path: '/tipos-cobrancas',
    component: () => import('./pages/tipos-cobrancas/Index.vue'),
    name: 'tipos-cobrancas'
},
{
    path: '/tipos-cobrancas/:id/edit',
    component: () => import('./pages/tipos-cobrancas/Form.vue'),
    name: 'tipos-cobrancas-edit'
},
{
    path: '/user-cotacoes-calcular',
    component: () => import('./pages/user-cotacoes/Form.vue'),
    name: 'user-cotacoes-calcular'
},
{
    path: '/user-cotacoes',
    component: () => import('./pages/user-cotacoes/Index.vue'),
    name: 'user-cotacoes'
},
{
    path: '/user-cotacoes/:id',
    component: () => import('./pages/user-cotacoes/Show.vue'),
    name: 'user-cotacoes-show'
}
];

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
    components: {
        App
    }
});
