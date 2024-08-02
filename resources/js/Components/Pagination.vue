<template>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="flex items-center -space-x-px h-10 text-base flex-wrap">
                <li v-for="link in links" :key="link.label">
                    <Link
                        v-html="link.label"
                        :href="link.url ?? ''"
                        :class="[
                            'flex items-center justify-center px-4 h-10 leading-tight border border-gray-300 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                            {
                                'text-gray-500 bg-white':
                                    !link.active && link.url,
                                'text-gray-500 bg-gray-100': !link.url,
                                'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:text-white dark:bg-gray-700':
                                    link.active,
                            },
                        ]"
                    />
                </li>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
        required: true,
    },
});
</script>
