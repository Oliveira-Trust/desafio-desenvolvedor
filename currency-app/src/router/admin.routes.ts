import AdminLayout from '@/presentation/layouts/AdminLayout.vue';
import HomePage from '@/presentation/pages/HomePage.vue';
import type { RouteRecordRaw } from 'vue-router';

export default <RouteRecordRaw[]>[
    {
        path: '/',
        component: AdminLayout,
        children: [
            {
                path: 'inicio',
                name: 'home',
                component: HomePage,
            },
        ],
        meta: {
            requiresAuth: true,
        },
    },
];
