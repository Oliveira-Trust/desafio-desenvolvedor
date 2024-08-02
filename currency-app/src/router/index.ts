import { useAuthStore } from '@/core/stores/auth.store';
import { createRouter, createWebHistory } from 'vue-router';
import adminRoutes from './admin.routes';
import authRoutes from './auth.routes';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            redirect: { name: 'home' },
        },
        ...authRoutes,
        ...adminRoutes,
    ],
});

router.beforeEach(async (to, from, next) => {
    if (to.meta.requiresAuth && !useAuthStore().isLoggedIn) {
        return next('/login');
    }

    next();
});

export default router;
