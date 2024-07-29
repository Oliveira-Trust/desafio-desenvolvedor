<script setup>
import { useToast } from 'vue-toastification'
import { onMounted, ref, watch } from 'vue'
import NavigationMenu from '@/Components/NavigationMenu.vue'
import { Link, usePage } from '@inertiajs/vue3'
import { useDisplay } from 'vuetify'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

const drawer = ref(false)
const rail = ref(false)
const { mobile } = useDisplay()
const toast = useToast()
const page = usePage()

watch(() => page.props.flash, (flash) => {
    if (flash.success) {
        toast.success(flash.success)
    }
    if (flash.error) {
        toast.error(flash.error)
    }
})

watch(mobile, (isMobile) => {
    drawer.value = !isMobile
})

onMounted(() => {
    drawer.value = !mobile.value
})

</script>

<template>
    <v-app class="bg-grey-lighten-4" prominent>
        <v-app-bar>
            <v-app-bar-nav-icon v-if="mobile" @click.stop="drawer = !drawer" />
            <v-app-bar-nav-icon v-else @click.stop="rail = !rail" />
            <v-toolbar-title ><ApplicationLogo :size="4" /> Desafio O.T. </v-toolbar-title>
<!--            <v-btn icon="mdi-dots-vertical" variant="text"></v-btn>-->
        </v-app-bar>
        <v-navigation-drawer v-model="drawer" :rail="rail" permanent>
            <v-list v-if="!rail">
                <v-list-item
                    :title="page.props.auth.user.name"
                    :subtitle="page.props.auth.user.email"
                    base-color="primary"
                />
            </v-list>
            <v-divider />
            <NavigationMenu />
            <template v-slot:append>
                <div class="pa-2">
                    <Link :href="route('logout')" method="post" as="div">
                        <v-btn v-if="!rail" block color="primary" append-icon="mdi-exit-to-app">
                            Sair
                        </v-btn>
                        <v-btn v-else size="small" icon="mdi-exit-to-app" color="primary"></v-btn>
                    </Link>
                </div>
            </template>
        </v-navigation-drawer>

        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>
