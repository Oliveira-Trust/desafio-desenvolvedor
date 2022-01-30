<template>
    <header>
        <nav>
            <div class="link">
                <NuxtLink to="/">
                    <Button>
                        Exchange
                    </Button>
                </NuxtLink>
            </div>
        </nav>
        <nav class="end">
            <div class="flex justify-center items-center" v-if="loggedIn">
                Olá, {{ userName }}
            </div>
            <div class="link" v-if="!loggedIn">
                <NuxtLink to="/login">
                    <Button>
                        Login
                    </Button>
                </NuxtLink>
            </div>
            <div class="link" v-else @click="logout">
                <Button>
                    Logout
                </Button>
            </div>
        </nav>
    </header>
</template>

<script lang="ts">
import Vue from 'vue'
import Button from './Button.vue';

export default Vue.extend({
    components: { Button },
    computed: {
        userName(): String {
            return this.$auth?.user?.name
        },
        loggedIn(): Boolean {
            return this.$auth.loggedIn
        }
    },
    methods: {
        logout(): void {
            this.$auth.logout('laravelSanctum')
        }
    }

})
</script>

<style scoped>
header { @apply flex w-full h-24 px-10 py-5 border-b border-gray-400 items-center; }
header nav { @apply flex w-full items-center space-x-5; }
header nav.end { @apply justify-end; }
nav .link { @apply flex; }
.link button { @apply px-3 py-2 border rounded hover:bg-gray-300; }
</style>
