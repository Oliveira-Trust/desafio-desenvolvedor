<template>
    <div>
    <div class="card">
        <div class="card-header">Histórico de Cotações</div>
            <div class="card-body">
                <table class="table table-dark table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo de Cobrança</th>
                            <th>Moeda Origem</th>
                            <th>Moeda Destino</th>
                            <th>Oferta de compra (bid)</th>
                            <th>Quantia</th>
                            <th>
                                <router-link 
                                    :to="{
                                        name: 'user-cotacoes-calcular'
                                    }"
                                    class="btn btn-primary btn-sm"
                                >
                                    Calcular
                                </router-link>                                  
                            </th>
                        </tr>
                    </thead>                
                    <tbody>
                        <tr v-for="(userCotacao, key) in userCotacoes" :key="key">
                            <td>{{ userCotacao.id }}</td>
                            <td>{{ userCotacao.tipo_cobranca.nom_tipo_cobranca }}</td>
                            <td>{{ userCotacao.moeda_origem_id }}</td>
                            <td>{{ userCotacao.moeda_destino_id }}</td>
                            <td>{{ userCotacao.val_bid }}</td>
                            <td>{{ userCotacao.val_quantia }}</td>
                            <td>
                                <router-link 
                                    :to="{
                                        name: 'user-cotacoes-show',
                                        params: { id: userCotacao.id }
                                    }" 
                                    class="btn btn-primary btn-sm"
                                >Show</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'lista-tipos-cobrancas',
        data() {
            return {
                userCotacoes: []
            }
        },
        created() {
            this.getUserCotacoes();
        },
        methods: {
            getUserCotacoes(){
                axios.get('api/v1/user-cotacoes')
                    .then((response) => {
                        console.log(response);
                        const data = response.data;
                        if(data.success == true){
                            this.userCotacoes = data.data;
                        }
                    })
                    .finally(() => {

                    });
            }
        }
    }
</script>

