import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/auth.js'


const router = new VueRouter({
    mode: 'history',
    base: import.meta.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
            meta: {
                auth: true
            }
        },
        {
            path: '/taxas',
            name: 'taxas',
            component: () => import('../views/Taxas/TaxasView.vue'),
            meta: {
                auth: true
            }
        },
        {
            path: '/conversor',
            name: 'conversor',
            component: () => import('../views/Conversor/ConversorView.vue'),
            meta: {
                auth: true
            }
        },
        {
            path: '/historico-conversoes',
            name: 'historico-conversoes',
            component: () => import('../views/HistoricoConversoesView.vue'),
            meta: {
                auth: true
            }
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/LoginView.vue')
        },
        {
            path: '/cadastro',
            name: 'cadastro',
            component: () => import('../views/CadastroView.vue')
        },
        {
            path: '*',
            component: () => import('../views/NotFoundView.vue')
        },
    ]
})
router.beforeEach((to, _, next) => {
    const authStore = useAuthStore();
    if (to.meta?.auth) {
        if (!authStore.accessToken) {
            return next({ name: 'login' })
        }
    }
    return next()
})
export default router
