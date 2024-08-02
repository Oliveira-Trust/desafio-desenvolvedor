<script setup>
import { Icon } from "@iconify/vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-green-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('conversao.index')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                >Converter Moedas</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-green-500"
                    >Registrar</Link
                >
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <Icon
                    icon="ph:money-wavy"
                    class="h-16 w-auto text-green-500 bg-gray-100 dark:bg-gray-900"
                />
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <a
                        href="https://docs.awesomeapi.com.br/api-de-moedas"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-green-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full"
                            >
                                <Icon
                                    icon="mdi:currency-usd-circle"
                                    class="w-7 h-7 text-yellow-300"
                                />
                            </div>

                            <h2
                                class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                API de Moedas
                            </h2>

                            <p
                                class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                            >
                                A API de Moedas da AwesomeAPI oferece acesso em
                                tempo real a dados sobre diversas moedas e suas
                                taxas de câmbio. Ideal para desenvolvedores que
                                precisam integrar informações financeiras em
                                seus aplicativos, esta API permite consultar
                                cotações, converter valores entre diferentes
                                moedas e obter dados históricos de taxas de
                                câmbio.
                            </p>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-green-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>

                    <a
                        href="https://laravel.com/docs/10.x/releases"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-green-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full"
                            >
                                <Icon icon="logos:laravel" class="w-7 h-7" />
                            </div>

                            <h2
                                class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Laravel
                            </h2>

                            <p
                                class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                            >
                                Laravel é um dos frameworks PHP mais populares e
                                poderosos para o desenvolvimento de aplicações
                                web. Criado por Taylor Otwell, Laravel oferece
                                uma arquitetura robusta e elegante que facilita
                                a construção de aplicações web de alta
                                qualidade, escaláveis e seguras. Com uma sintaxe
                                expressiva e fácil de entender, Laravel é
                                projetado para tornar o desenvolvimento mais
                                ágil e agradável.
                            </p>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-green-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>

                    <a
                        href="https://vuejs.org/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-green-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full"
                            >
                                <Icon icon="logos:vue" class="w-7 h-7" />
                            </div>

                            <h2
                                class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Vue.js
                            </h2>

                            <p
                                class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                            >
                                Vue.js é um framework progressivo para a
                                construção de interfaces de usuário e aplicações
                                web. Criado por Evan You, Vue.js se destaca por
                                sua simplicidade e flexibilidade, permitindo a
                                criação de aplicativos interativos e dinâmicos
                                com facilidade. Projetado para ser incrementado,
                                Vue.js pode ser integrado em projetos existentes
                                e adaptado para atender às necessidades
                                específicas de desenvolvimento.
                            </p>
                        </div>

                        <svg
                            xmlns="https://inertiajs.com/"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-green-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>

                    <a
                        href="https://inertiajs.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-green-500"
                    >
                        <div>
                            <div
                                class="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full"
                            >
                                <Icon
                                    icon="simple-icons:inertia"
                                    class="w-7 h-7 text-gray-900"
                                />
                            </div>

                            <h2
                                class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Inertia.js
                            </h2>

                            <p
                                class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                            >
                                Inertia.js é uma biblioteca inovadora para o
                                desenvolvimento de aplicações web modernas, que
                                combina a simplicidade das aplicações de página
                                única (SPA) com a robustez dos frameworks
                                tradicionais de servidor. Criado para permitir
                                uma experiência de desenvolvimento mais fluida e
                                coesa, o Inertia.js atua como uma ponte entre o
                                backend e o frontend, proporcionando uma maneira
                                eficaz de construir interfaces interativas sem
                                sacrificar a familiaridade com as tecnologias de
                                servidor.
                            </p>
                        </div>

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="self-center shrink-0 stroke-green-500 w-6 h-6 mx-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                            />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between"
            >
                <div class="text-center text-sm sm:text-start">&nbsp;</div>

                <div
                    class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
