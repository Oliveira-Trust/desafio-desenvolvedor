<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <a href="#"><img width="290" src="https://www.oliveiratrust.com.br/wp-content/themes/OliveiraTrust_WP/assets/img/logotipo_padrao_grey.svg"></a><br>
            <span class="text-secondary"></span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/currency" class="nav-item nav-link">Conversão de moeda</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Sair</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/login" class="nav-item nav-link">Login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Registro
                    </router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
    export default {
        name: "App",
        data() {
            return {
                isLoggedIn: false,
            }
        },
        created() {
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
        },
        mounted () {
            if (window.location.pathname == '/')
                    window.location.href = "/login";
        },
        methods: {
            logout(e) {
                e.preventDefault();
                this.$axios.get('/sanctum/csrf-cookie').then(response => {
                    this.$axios.post('/api/logout')
                        .then(response => {
                            if (response.data.success) {
                                window.location.href = "/login"
                            } else {
                                console.log(response)
                            }
                        }).catch(function (error) {
                            console.error(error);
                        });
                })
            }
        },
    }
</script>
