import '@/assets/styles/main.scss';
import { LightTheme } from '@/core/themes/light.theme';
import { createVuetify } from 'vuetify';
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg';
import { en, pt } from 'vuetify/locale';

export default createVuetify({
    locale: {
        locale: 'pt',
        fallback: 'en',
        messages: { pt, en },
    },
    defaults: {},
    theme: {
        defaultTheme: 'light',
        themes: {
            light: LightTheme,
        },
    },
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
    display: {
        mobileBreakpoint: 'sm',
    },
});
