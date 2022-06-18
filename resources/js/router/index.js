import {createWebHistory, createRouter} from "vue-router";
import {store} from '../store/index'

const routes = [
    {
        path: "/",
        name: "index",
        component: () => import("../pages/Index.vue"),
        meta: {requiresAuth: false}
    },
    {
        path: "/auth/login",
        name: "login",
        component: () => import("../pages/AuthLogin.vue"),
        meta: {requiresAuth: false}
    },
    {
        path: "/auth/register",
        name: "register",
        component: () => import("../pages/AuthRegister.vue"),
        meta: {requiresAuth: false}
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const isAuthenticated = store.state.user.id > 0;
    const isAdmin = store.state.user.is_admin;

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({name: 'login'});
    } else if ((!to.meta.requiresAuth && isAuthenticated && !isAdmin) ||
        (to.meta.requiresAuth && isAuthenticated && to.meta.isAdmin && !isAdmin)) {
        next({name: 'index'});
    } else if ((!to.meta.requiresAuth && isAuthenticated && isAdmin) ||
        (to.meta.requiresAuth && isAuthenticated && !to.meta.isAdmin && isAdmin)) {
        next({name: 'admin'});
    } else {
        next()
    }
});

export default router;
