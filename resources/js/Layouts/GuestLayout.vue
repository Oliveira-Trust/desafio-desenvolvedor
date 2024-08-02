<script setup>
import { Icon } from "@iconify/vue";
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <Link href="/">
                <ApplicationLogo class="" />
                <Icon icon="ph:money-wavy" class="w-20 h-20 fill-current text-green-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
        <h5 class="text-lg mb-10 font-bold">Conversor de Moeda</h5>
            <slot />
        </div>
    </div>
</template>
