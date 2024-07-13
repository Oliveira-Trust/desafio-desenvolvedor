<script setup lang="ts"></script>

<template>
    <header>
        <div class="w-full container mx-auto">
            <div class="w-full flex items-center justify-between">
                <a
                    class="flex items-center text-trust-p3 no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="/"
                >
                    Currency<span
                        class="bg-clip-text text-transparent bg-trust-p7 from-trust-p7 via-trust-p2 to-trust-p1"
                        >Converter</span
                    >
                </a>

                <div class="flex w-1/2 justify-end content-center">
                    <router-link
                        class="inline-block text-trust-p5 no-underline hover:text-trust-p7 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 transform hover:scale-125 duration-300 ease-in-out"
                        :to="{ name: 'about' }"
                    >
                        About
                    </router-link>
                </div>
            </div>
        </div>
    </header>
    <main class="h-full">
        <router-view />
    </main>
    <footer class="top-0 w-full px-6 py-0 text-trust-p10">
        <div class="pt-16 pb-6 text-sm text-center md:text-left fade-in">
            <a class="text-gray-500 no-underline hover:no-underline" href="#"
                >&copy; Currency Converter</a
            >
        </div>
    </footer>
</template>
