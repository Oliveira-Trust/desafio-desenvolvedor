import EmptyLayout from '@/presentation/layouts/EmptyLayout.vue';
import LoginPage from '@/presentation/pages/LoginPage.vue';
import type { RouteRecordRaw } from 'vue-router';

export default <RouteRecordRaw[]>[
    {
        path: '/',
        component: EmptyLayout,
        children: [
            {
                path: 'login',
                name: 'login',
                component: LoginPage,
            },
        ],
    },
];
