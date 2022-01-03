import {createWebHistory, createRouter} from "vue-router";

import Register from '../pages/register';
import Login from '../pages/login';
import Currency from '../pages/currency';

export const routes = [
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'currency',
        path: '/currency',
        component: Currency
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
