<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="alert alert-danger" role="alert" v-if="error !== null">
                    {{ error }}
                </div>

                <div class="card card-default">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right" :class="{'error-label': errorInput.email}">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required
                                           autofocus autocomplete="off" :class="{'error-input': errorInput.email }">
                                    <div class="alert-error" role="alert" v-if="message.email !== null">
                                        {{ message.email }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" :class="{'error-label': errorInput.password}">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password"
                                           required autocomplete="off" :class="{'error-input': errorInput.password }">
                                    <div class="alert-error" role="alert" v-if="message.password !== null">
                                        {{ message.password }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Login
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
                email: "",
                password: "",
                message : {
                    email: null,
                    password: null,
                },
                error: null,
                errorInput: {
                    email: false,
                    password: false,
                }
            }
        },
        watch: {
            email: function () {
                this.validationEmail()
            },
            password: function () {
                this.validationPassword()
            }
        },
        methods: {
            validationEmail () {

                if (this.email.indexOf('@') < 0 ) {
                    this.message.email = "This e-mail is not valid!";
                    this.errorInput.email = true;
                    return true;
                }

                if (this.email.length <= 0) {
                    this.message.email = "This e-mail invalid";
                    this.errorInput.email = true;
                    return true;
                }

                this.message.email = null;
                this.errorInput.email = false;
                return false;
            },
            validationPassword () {
                if (this.password.length < 6) {
                    this.message.password = "This password is wrong, minimum is 6 characters";
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
                confirmation.password = this.validationPassword();

                if (confirmation.email === false && confirmation.password === false) {
                    this.$axios.get('/sanctum/csrf-cookie').then(response => {
                        this.$axios.post('api/login', {
                            email: this.email,
                            password: this.password
                        })
                            .then(response => {
                                console.log(response.data);
                                if (response.data.success) {
                                    this.$router.go('/currency')
                                } else {
                                    this.error = response.data.message
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
                return next('currency');
            }
            next();
        }
    }
</script>
<style scoped>
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
