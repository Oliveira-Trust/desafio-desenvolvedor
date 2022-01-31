<template>
    <div class="mx-auto md:max-w-2xl">
        <Card>
            <h2 class="text-center text-xl">Login</h2>

            <form @submit.prevent="login" method="post" action="/login">
                <div class="mt-5 space-y-5">
                    <div class="group-input">
                        <label for="name">Nome</label>
                        <input type="text" id="name" v-model="form.name" name="name" required />

                        <div v-if="errors.name" class="text-red-500 bg-red-200 mt-2 p-2 border border-red-500 rounded">
                            <span v-for="(message, index) in errors.name" :key="index">{{ message }}</span>
                        </div>
                    </div>

                    <div class="group-input">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" v-model="form.email" name="email" required />

                        <div v-if="errors.email" class="text-red-500 bg-red-200 mt-2 p-2 border border-red-500 rounded">
                            <span v-for="(message, index) in errors.email" :key="index">{{ message }}</span>
                        </div>
                    </div>

                    <div class="group-input">
                        <label for="password">Senha</label>
                        <input type="password" id="password" v-model="form.password" name="password" required />

                        <div v-if="errors.password" class="text-red-500 bg-red-200 mt-2 p-2 border border-red-500 rounded">
                            <span v-for="(message, index) in errors.password" :key="index">{{ message }}</span>
                        </div>
                    </div>

                    <div class="group-input">
                        <label for="password_confirmation">Confirmar senha</label>
                        <input type="password" id="password_confirmation" v-model="form.password_confirmation" name="password_confirmation" required />

                        <div v-if="errors.password_confirmation" class="text-red-500 bg-red-200 mt-2 p-2 border border-red-500 rounded">
                            <span v-for="(message, index) in errors.password_confirmation" :key="index">{{ message }}</span>
                        </div>

                        <div v-if="form.password !== form.password_confirmation" class="text-red-500 bg-red-200 mt-2 p-2 border border-red-500 rounded">
                            <span>The password must be the same!</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-5">
                        <Button class="mt-5" type="submit" :disabled="!registerBusy">Registrar-se</Button>
                    </div>
                </div>
            </form>

        </Card>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Card from '~/components/Card.vue'
import Button from '~/components/Button.vue'

export default Vue.extend({
    middleware: 'auth',
    auth: 'guest',
    components: { Card, Button },
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {}
        };
    },
    methods: {
        async login() {
            await this.$axios.$get('/laravel/sanctum/csrf-cookie')
            await this.$axios.$post('/laravel/register', this.form)
                .then(res => this.$auth.loginWith('laravelSanctum', { data: this.form }))
        },
        registerBusy(): Boolean {
            return this.$auth.busy
        }
    }
})
</script>

<style scoped>
.group-input { @apply flex flex-col space-y-1; }
input { @apply rounded; }
</style>
