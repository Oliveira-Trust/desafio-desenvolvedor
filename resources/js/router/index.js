import { createRouter, createWebHistory } from "vue-router";
import Home from "../view/Home.vue";
import About from "../view/About.vue";
import Show from "../view/Show.vue";
import { useAuth } from "../stores/auth.js";
import Settings from "../view/Settings.vue";
import History from "../view/History.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/about",
        name: "about",
        component: About,
    },
    {
        path: "/show",
        name: "show",
        component: Show,
        meta: {
            auth: true,
        },
    },
    {
        path: "/settings",
        name: "settings",
        component: Settings,
        meta: {
            auth: true,
        },
    },
    {
        path: "/history",
        name: "history",
        component: History,
        meta: {
            auth: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const auth = useAuth();
    const isAuth = to.meta?.auth;

    if (isAuth && auth.hasUser) {
        await auth.checkToken();
    }

    if (isAuth && !auth.hasUser) {
        return next({ name: "home" });
    }

    next();
});

export default router;
