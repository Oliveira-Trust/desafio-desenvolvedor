import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import { pt } from 'vuetify/locale'

const vuetify = createVuetify({
    components,
    theme: {
        defaultTheme: 'myCustomTheme',
        themes: {
            myCustomTheme: {
                colors: {
                    primary: '#2196F3',
                    secondary: '#FFC107',
                }
            }
        },
    },
    locale: {
        locale: 'pt',
        fallback: 'pt',
        messages: { pt },
        current: pt,
    },
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
})

export default vuetify
