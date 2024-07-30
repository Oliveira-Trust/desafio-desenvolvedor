<script setup>
import { Link, router } from '@inertiajs/vue3'

const menu = [
    {
        title: 'Cotação',
        name: 'quote.index',
        icon: 'mdi mdi-cash-sync',
        route_uri: '/quote',
    },
    {
        title: 'Taxas',
        name: 'tax-settings.index',
        icon: 'mdi mdi-cog',
        route_uri: '/tax-settings',
    },
]

const checkActiveRoute = (item) => {
    if(router.page.url === item.route_uri) {
        return true
    }
};
</script>

<template>
    <v-list nav>
        <!-- List Menu -->
        <Link v-for="(item, key) in menu" :key="key" :href="route(item.name)" as="div">
            <v-list-item
                :prepend-icon="item.icon"
                :title="item.title"
                :exact="item.exact"
                :active="checkActiveRoute(item)"
                link
                color="primary"
            />
        </Link>
    </v-list>
</template>
