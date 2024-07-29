import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import vuetify from './Plugins/vuetify'
import toast from './Plugins/toast'
import VueTheMask from 'vue-the-mask'
import money from 'v-money'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

let promise = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(vuetify)
            .use(toast)
            .use(VueTheMask)
            .use(money, {precision: 2})
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
})
