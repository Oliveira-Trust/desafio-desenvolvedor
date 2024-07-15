<script setup>
import useAuth from "../stores/auth.js";
const auth = useAuth();
</script>

<template>
    <div v-show="auth.hasUser" class="flex w-1/2 justify-end content-center">
        <router-link
            class="rounded-bl-xl text-trust-p1 bg-trust-p3 inline-block no-underline hover:bg-trust-p2 hover:text-trust-p1 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 transform duration-300 ease-in-out"
            :to="{ name: 'settings' }"
        >
            Settings
        </router-link>
        <router-link
            class="text-trust-p1 bg-trust-p3 inline-block no-underline hover:bg-trust-p2 hover:text-trust-p1 text-center h-10 p-2 md:h-auto md:p-4 transform duration-300 ease-in-out"
            :to="{ name: 'history' }"
        >
            History
        </router-link>
        <router-link
            class="rounded-br-xl text-trust-p1 bg-trust-p3 inline-block no-underline hover:bg-trust-p2 hover:text-trust-p1 text-center h-10 p-2 md:h-auto md:p-4 transform duration-300 ease-in-out"
            :to="{ name: 'show' }"
        >
            Converter
        </router-link>
    </div>
    <div v-show="!auth.hasUser" class="flex w-1/2 justify-end content-center">
        <router-link
            class="inline-block text-trust-p5 no-underline hover:text-trust-p7 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 transform hover:scale-125 duration-300 ease-in-out"
            :to="{ name: 'about' }"
        >
            About
        </router-link>
    </div>
</template>
