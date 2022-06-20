<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black bg-opacity-25"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <DialogPanel class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">{{ isLogin ? 'Login' : 'Criar minha conta' }}</DialogTitle>

                            <form @submit.prevent="submit" class="mt-2">
                                <div v-if="!isLogin" class="input-form" :class="{'has-errors': getError(this.errors, 'name') !== ''}">
                                    <label for="email">Nome</label>
                                    <div class="input-form-row">
                                        <div class="input-form-group h-10">
                                            <input type="text" id="name" v-model="form.name" placeholder="Digite o seu nome">
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'name') !== ''">{{ getError(this.errors, 'name') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'email') !== ''}">
                                    <label for="email">E-mail</label>
                                    <div class="input-form-row">
                                        <div class="input-form-group h-10">
                                            <input type="email" id="email" v-model="form.email" placeholder="Digite o seu email">
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'email') !== ''">{{ getError(this.errors, 'email') }}</p>
                                </div>

                                <div class="input-form" :class="{'has-errors': getError(this.errors, 'password') !== ''}">
                                    <label for="password">Senha</label>
                                    <div class="input-form-row">
                                        <div class="input-form-group h-10">
                                            <input type="password" id="password" v-model="form.password" placeholder="Digite a sua senha">
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'password') !== ''">{{ getError(this.errors, 'password') }}</p>
                                </div>

                                <div v-if="!isLogin" class="input-form" :class="{'has-errors': getError(this.errors, 'password_confirmation') !== ''}">
                                    <label for="password_confirmation">Repetir senha</label>
                                    <div class="input-form-row">
                                        <div class="input-form-group h-10">
                                            <input type="password" id="password_confirmation" v-model="form.password_confirmation" placeholder="Digite a sua senha novamente">
                                        </div>
                                    </div>

                                    <p class="msg-error" v-if="getError(this.errors, 'password_confirmation') !== ''">{{ getError(this.errors, 'password_confirmation') }}</p>
                                </div>

                                <div class="mt-10">
                                    <button class="button-login" :class="{'button-loading': isLoading}">
                                        <div class="icon-loading mr-2" v-if="isLoading">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                        </div>

                                        <span v-if="isLoading">{{ isLogin ? 'Realizando login...' : 'Realizando cadastro...' }}</span>
                                        <span v-else>{{ isLogin ? 'Entrar' : 'Fazer cadastro' }}</span>
                                    </button>
                                </div>
                            </form>

                            <button type="button" @click="isLogin = !isLogin" class="button-link mt-10">
                                {{
                                    isLogin
                                        ? 'Não tem conta? Clique aqui para criar a sua conta gratuitamente.'
                                        : 'Já tem uma conta? Clique aqui para fazer o login.'
                                }}
                            </button>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import {TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle} from '@headlessui/vue'
import {getError} from '../utils/getError'

export default {
    components: {
        TransitionRoot, TransitionChild, Dialog, DialogPanel, DialogTitle
    },

    data() {
        return {
            isOpen: false,
            isLogin: true,
            isLoading: false,
            callback: null,
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {}
        }
    },

    methods: {
        fazerLogin(isLogin, value, callback) {
            if (this.$store.state.user.id > 0) {
                callback();

                return;
            }

            this.form = {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
            this.errors = {};
            this.isLoading = false;
            this.isLogin = isLogin
            this.isOpen = value
            this.callback = callback;
        },

        closeModal() {
            this.isOpen = false
        },

        submit(forceLogin) {
            if (this.isLoading) {
                return;
            }

            this.isLoading = true;
            this.errors = {};

            const url = this.isLogin || forceLogin === true ? '/auth/login' : '/auth/register';

            this.axios.post(url, this.form)
                .then((response) => {
                    this.isLoading = false;

                    if (this.isLogin || forceLogin === true) {
                        const user = response.data.user;

                        this.$store.commit('setUser', {
                            id: user.id,
                            name: user.name,
                            email: user.email,
                            is_admin: user.is_admin > 0,
                            token: response.data.token
                        });

                        if (this.callback && typeof this.callback === "function") {
                            this.callback();
                        }

                        this.closeModal();
                    } else {
                        //Fazer o login depois de realizar o cadastro
                        this.submit(true);
                    }
                })
                .catch((error) => {
                    this.isLoading = false;

                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                });
        },

        logout() {
            this.axios.post('/auth/logout')
                .then(() => {
                    this.clearUserData();
                })
                .catch((err) => {
                    this.clearUserData();
                })
        },

        clearUserData() {
            this.$store.commit('removeUser');
            this.isLoading = true;
            this.errors = {};
        },

        getError
    }
}
</script>
