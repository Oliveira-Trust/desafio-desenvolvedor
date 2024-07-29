<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'


const phoneMask = '(##) #####-####'

const props = defineProps({
    'accounting': Array,
})

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})
const showPassword = ref(false)

const submit = () => {
    form.post('/register', {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Registre-se" />
        <v-col cols="12" sm="12" md="10" lg="4">
            <div class="d-flex justify-center">
                <Link href="/" as="div">
                    <ApplicationLogo />
                </Link>
            </div>
            <v-card class="px-6 py-4 mt-3 elevation-2 rounded-lg">
                <v-card-title class="text-center">Crie sua conta</v-card-title>
                <v-form @submit.prevent="submit" class="mt-5">
                    <v-text-field
                        v-model="form.name"
                        label="Nome"
                        type="text"
                        variant="outlined"
                        density="compact"
                        placeholder="Digite seu Nome"
                        :error-messages="form.errors.name"
                    />
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        type="email"
                        variant="outlined"
                        density="compact"
                        placeholder="Digite seu email"
                        :error-messages="form.errors.email"
                    />
                    <v-text-field
                        v-model="form.password"
                        label="Senha"
                        density="compact"
                        variant="outlined"
                        placeholder="Digite sua senha"
                        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                        :type="showPassword ? 'text' : 'password'"
                        :error-messages="form.errors.password"
                        @click:append-inner="showPassword = !showPassword"
                    />
                    <v-text-field
                        v-model="form.password_confirmation"
                        label="Confirmação de senha"
                        density="compact"
                        variant="outlined"
                        placeholder="Confirme sua senha"
                        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                        :type="showPassword ? 'text' : 'password'"
                        :error-messages="form.errors.password_confirmation"
                        @click:append-inner="showPassword = !showPassword"
                    />
                    <v-btn :loading="form.processing" type="submit" block color="primary" class="mb-12">Registrar
                    </v-btn>
                    <Link :href="route('login')" as="div">
                        <v-btn color="primary">Voltar</v-btn>
                    </Link>
                </v-form>
            </v-card>
        </v-col>
    </GuestLayout>
</template>
