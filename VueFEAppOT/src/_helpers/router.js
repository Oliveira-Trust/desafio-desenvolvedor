import Vue from 'vue';
import Router from 'vue-router';

import { authenticationService } from '@/_services';
import { Role } from '@/_helpers';
import HomePage from '@/components/home/HomePage';
import AdminPage from '@/components/admin/AdminPage';
import LoginPage from '@/components/login/LoginPage';
import ConversaoPage from '@/components/conversion/ConversionPage';

Vue.use(Router);

export const router = new Router({
    mode: 'history',
    routes: [
        { 
            path: '/', 
            component: HomePage, 
            meta: { authorize: [] } 
        },
        { 
            path: '/admin', 
            component: AdminPage, 
            meta: { authorize: [Role.is_admin] } 
        },
        { 
            path: '/login', 
            component: LoginPage 
        },
        { 
            path: '/conversion', 
            component: ConversaoPage 
        },
        // otherwise redirect to home
        { path: '*', redirect: '/' }
    ]
});

router.beforeEach((to, from, next) => {
    // redirect to login page if not logged in and trying to access a restricted page
    const { authorize } = to.meta;
    const currentUser = authenticationService.currentUserValue;

    if (authorize) {
        if (!currentUser) {
            // not logged in so redirect to login page with the return url
            return next({ path: '/login', query: { returnUrl: to.path } });
        }

        // check if route is restricted by role
        if (authorize.length && !authorize.includes(currentUser.role)) {
            // role not authorised so redirect to home page
            return next({ path: '/' });
        }
    }

    next();
})