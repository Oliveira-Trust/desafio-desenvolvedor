<script setup>
import { watch } from 'vue'
import { useToast } from 'vue-toastification'
import { usePage } from '@inertiajs/vue3'

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
</script>

<template>
    <v-app class="bg-grey-lighten-4">
        <v-main>
            <v-container fluid>
                <v-row align="center" justify="center" style="height: 100vh">
                    <slot />
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
