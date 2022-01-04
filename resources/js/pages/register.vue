<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!--<div class="alert alert-danger" role="alert" v-if="message !== null">-->
                    <!--{{ message }}-->
                <!--</div>-->

                <div class="card card-default">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label text-md-right" :class="{'error-label': errorInput.name}">Nome</label>
                                <div class="col-md-6">
                                    <input id="name" type="email" class="form-control" v-model="name" required
                                           autofocus autocomplete="off" :class="{
                                                'error-input': errorInput.name
                                            }"
                                    >
                                    <div class="alert-error" role="alert" v-if="message.name !== null">
                                        {{ message.name }}
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right" :class="{'error-label': errorInput.email}"> E-mail</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off" :class="{'error-input': errorInput.email}">
                                    <div class="alert-error" role="alert" v-if="message.email !== null">
                                        {{ message.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" :class="{'error-label': errorInput.password}"> Senha</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off" :class="{'error-input': errorInput.password}">
                                    <div class="alert-error" role="alert" v-if="message.password !== null">
                                        {{ message.password }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Cadastrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: "",
                email: "",
                password: "",
                message : {
                    name: null,
                    email: null,
                    password: null,
                },
                error: false,
                errorInput: {
                    name: false,
                    email: false,
                    password: false,
                }
            }
        },
        watch: {
            email: function () {
                this.validationEmail()
            },
            name: function() {
                this.validationName()
            },
            password: function () {
                this.validationPassword()
            }
        },
        methods: {
            validationEmail () {
                if (this.email.indexOf('@') < 0 ) {
                    this.message.email = "Esse e-mail não está valido!";
                    this.errorInput.email = true;
                    return true;
                }

                this.message.email = null;
                this.errorInput.email = false;
                return false;
            },
            validationName () {
                if (this.name.length < 6) {
                    this.message.name = "O nome deve conter pelo menos mais de 6 caracteres";
                    this.errorInput.name = true;
                    return true;
                }

                this.message.name = null;
                this.errorInput.name = false;
                return false;
            },
            validationPassword () {
                if (this.password.length < 6) {
                    this.message.password = "A senha deve ter conter pelo mneos mais de 6 caracteres";
                    this.errorInput.password = true;
                    return true;
                }

                this.message.password = null;
                this.errorInput.password = false;
                return false;
            },
            handleSubmit(e) {
                e.preventDefault();

                let confirmation = {};
                confirmation.email = this.validationEmail();
                confirmation.name = this.validationName();
                confirmation.password = this.validationPassword();

                if (confirmation.email === false && confirmation.name === false && confirmation.password === false) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        this.$axios.post('api/register', {
                            name: this.name,
                            email: this.email,
                            password: this.password
                        })
                            .then(response => {
                                if (response.data.success) {
                                    window.location.href = "/login"
                                } else {
                                    this.message = response.data.message
                                }
                            })
                            .catch(function (error) {
                                console.error(error);
                            });
                    })
                }
            }
        },
        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                return next('dashboard');
            }
            next();
        }
    }
</script>

<style scoped>

    .btn-primary {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #d40000;
        border-color: #d40000;
    }

    .error-input {
        border: solid 1px red;
    }

    .error-label {
        color: red;
    }

    .alert-error {
        color: red;
        font-size: 12px;
    }
</style>
