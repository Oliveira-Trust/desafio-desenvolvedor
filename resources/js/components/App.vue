<script setup lang="ts">
import Navbar from "./Navbar.vue";
</script>

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
                <Navbar />
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
