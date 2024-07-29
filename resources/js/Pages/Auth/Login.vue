<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})
const showPassword = ref(false)

const submit = () => {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    })
}
</script>
<script>
export default {
    name: 'LoginPage',
}
</script>

<template>
    <GuestLayout>
        <Head title="Login" />
        <v-col cols="12" sm="12" md="10" lg="4">
            <div class="d-flex justify-center">
                <Link href="/" as="div">
                    <ApplicationLogo />
                </Link>
            </div>
            <v-card class="px-6 py-4 mt-3 elevation-2 rounded-lg">
                <v-card-title class="text-center">
                    <div class="d-flex justify-space-between align-center">
                        <h3 class=" text-center mb-0">Login</h3>
                        <Link :href="route('register')" class="text-primary text-decoration-none">Ainda não tem conta?</Link>
                    </div>
                </v-card-title>
                <v-form @submit.prevent="submit" class="mt-5">
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        type="email"
                        variant="outlined"
                        density="compact"
                        placeholder="Digite seu email"
                        prepend-inner-icon="mdi-email-outline"
                        :error-messages="form.errors.email"
                    />
                    <v-text-field
                        v-model="form.password"
                        label="Senha"
                        density="compact"
                        variant="outlined"
                        placeholder="Digite sua senha"
                        prepend-inner-icon="mdi-lock-outline"
                        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                        :type="showPassword ? 'text' : 'password'"
                        :error-messages="form.errors.password"
                        @click:append-inner="showPassword = !showPassword"
                    />
                    <v-checkbox v-model="form.remember" label="Lembrar-me" />

                    <v-btn :loading="form.processing" type="submit" block color="primary" class="mb-12">Login</v-btn>

                </v-form>
            </v-card>
        </v-col>
    </GuestLayout>
</template>
