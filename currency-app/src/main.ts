import '@/assets/styles/base.scss';
import { createApp } from 'vue';
import App from './App.vue';
import { configuration } from './core/configuration';
import { registerPlugins } from './core/plugins';

async function bootstrap() {
    await configuration.initialize();

    const app = createApp(App);
    registerPlugins(app);

    try {
        document.title = `${configuration.applicationName} (v${configuration.applicationVersion})`;
    } catch (err: unknown) {
        console.error('err');
    }

    app.mount('#app');
}

bootstrap().then(() => {
    if (configuration.environment === 'development') {
        console.info('Aplicação iniciada (versão %s)', configuration.applicationVersion);
    }
});
