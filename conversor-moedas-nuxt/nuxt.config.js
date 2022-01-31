export default {
    // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
    ssr: false,

    // Global page headers: https://go.nuxtjs.dev/config-head
    head: {
        title: 'conversor-moedas-nuxt',
        htmlAttrs: {
            lang: 'en'
        },
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: '' },
            { name: 'format-detection', content: 'telephone=no' }
        ],
        link: [
            { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
        ]
    },

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [{ src: '~/plugins/vuex-persist', ssr: false }],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        // https://go.nuxtjs.dev/typescript
        '@nuxt/typescript-build',
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        '@nuxtjs/axios',
        '@nuxtjs/auth-next'
    ],

    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {
    },

    axios: {
        withCredentials: true,
        credentials: true,
        proxy: true,
        headers: {
            common: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        }
    },
    proxy: {
        '/laravel': {
            target: 'http://localhost',
            pathRewrite: { '^/laravel': '/' }
        }
    },
    auth: {
        strategies: {
            cookie: {
                cookie: {
                  // (optional) If set, we check this cookie existence for loggedIn check
                  name: 'XSRF-TOKEN',
                },
                endpoints: {
                  // (optional) If set, we send a get request to this endpoint before login
                  csrf: {
                    url: 'sanctum/csrf-cookie'
                  }
                }
            },
            laravelSanctum: {
                provider: 'laravel/sanctum',
                url: 'http://localhost'
            },
            local: {
                endpoints: {
                    login: { url: '/login', method: 'post' },
                    logout: { url: '/logout', method: 'post' },
                    user: { url: '/api/user', method: 'get' }
                }
            }
        }
    }
}
