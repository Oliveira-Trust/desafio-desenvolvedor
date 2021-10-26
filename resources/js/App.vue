<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'user-cotacoes-calcular' }">Cotacao</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'user-cotacoes' }">Histórico de Cotacões</router-link>
                        </li>


                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'tipos-cobrancas' }">Tipo Cobrança</router-link>
                        </li>                        
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'cotacoes-taxas' }">Cotacao Taxa</router-link>
                        </li>
                        <!--
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'cotacoes-taxas-ranges' }">Cotacao Taxa Range</router-link>
                        </li>
                        -->                    
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <button class="btn btn-danger" @click="logout">
                            Logout
                        </button>
                    </ul>
                </div>
            </div>
        </nav>    
        <div class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'app',
        data() {
            return {
                loading: false,
                form: {
                    email: '',
                    password: '',
                    device_name: 'browser',
                },
                errors: {}
            }
        },
        created() {
        },
        methods: {
            logout(){
                axios.post('api/v1/sanctum/logout')
                    .then(response => {
                        console.log('response', response);
                        const data = response.data;

                        if(data.success){
                            localStorage.removeItem('token');
                            this.$router.push('/login');
                        }
                    })
            }
        }
    }
</script>

