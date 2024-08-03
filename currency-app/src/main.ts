import '@/assets/styles/base.scss';
import { createApp } from 'vue';
import App from './App.vue';
import { configuration } from './core/configuration';
import { registerPlugins } from './core/plugins';
import {useAuthStore} from "@/core/stores/auth.store";
import {hasAuthenticationCookie} from "@/infrastructure/http/axios-config";
import router from "@/router";

async function bootstrap() {
    const app = createApp(App);
    registerPlugins(app);

    try {
        document.title = `${configuration.applicationName} (v${configuration.applicationVersion})`;

        if (hasAuthenticationCookie()) {
            await useAuthStore().checkUserAuthenticated();
            await router.push({ name: 'home' });
        }
    } catch (err: unknown) {
        //
    }

    app.mount('#app');
}

bootstrap().then(() => {
    if (configuration.environment === 'development') {
        console.info('Aplicação iniciada (versão %s)', configuration.applicationVersion);
    }
});
