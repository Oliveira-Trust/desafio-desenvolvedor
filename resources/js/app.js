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
    path: '/login',
    component: () => import('./pages/auth/Login.vue'),
    name: 'login'
},

{
    path: '/cotacoes-taxas/create',
    component: () => import('./pages/taxas/Form.vue'),
    name: 'cotacoes-taxas-create',
    meta: { requiresAuth: true }
},
{
    path: '/cotacoes-taxas',
    component: () => import('./pages/taxas/Index.vue'),
    name: 'cotacoes-taxas',
    meta: { requiresAuth: true }
},
{
    path: '/cotacoes-taxas/:id/edit',
    component: () => import('./pages/taxas/Form.vue'),
    name: 'cotacoes-taxas-edit',
    meta: { requiresAuth: true }
},
{
    path: '/cotacoes-taxas-ranges/create',
    component: () => import('./pages/taxas-ranges/Form.vue'),
    name: 'cotacoes-taxas-ranges-create',
    meta: { requiresAuth: true }
},
{
    path: '/cotacoes-taxas-ranges',
    component: () => import('./pages/taxas-ranges/Index.vue'),
    name: 'cotacoes-taxas-ranges',
    meta: { requiresAuth: true }
},
{
    path: '/cotacoes-taxas-ranges/:id/edit',
    component: () => import('./pages/taxas-ranges/Form.vue'),
    name: 'cotacoes-taxas-ranges-edit',
    meta: { requiresAuth: true }
},
{
    path: '/tipos-cobrancas/create',
    component: () => import('./pages/tipos-cobrancas/Form.vue'),
    name: 'tipos-cobrancas-create',
    meta: { requiresAuth: true }
},
{
    path: '/tipos-cobrancas',
    component: () => import('./pages/tipos-cobrancas/Index.vue'),
    name: 'tipos-cobrancas',
    meta: { requiresAuth: true }
},
{
    path: '/tipos-cobrancas/:id/edit',
    component: () => import('./pages/tipos-cobrancas/Form.vue'),
    name: 'tipos-cobrancas-edit',
    meta: { requiresAuth: true }
},
{
    path: '/user-cotacoes-calcular',
    component: () => import('./pages/user-cotacoes/Form.vue'),
    name: 'user-cotacoes-calcular',
    meta: { requiresAuth: true }
},
{
    path: '/user-cotacoes',
    component: () => import('./pages/user-cotacoes/Index.vue'),
    name: 'user-cotacoes',
    meta: { requiresAuth: true }
},
{
    path: '/user-cotacoes/:id',
    component: () => import('./pages/user-cotacoes/Show.vue'),
    name: 'user-cotacoes-show',
    meta: { requiresAuth: true }
}
];

const router = new VueRouter({
    mode: 'history',
    routes
})

function loggedIn(){
    return localStorage.getItem('token');
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

const app = new Vue({
    el: '#app',
    router,
    components: {
        App
    }
});
