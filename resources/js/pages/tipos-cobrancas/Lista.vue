<template>
    <div>
    <div class="card">
        <div class="card-header">Tipo Cobrança</div>
            <div class="card-body">
                <table class="table table-dark table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo de Cobrança</th>
                            <th>Status</th>
                            <th>
                                <router-link 
                                    :to="{
                                        name: 'tipos-cobrancas-create'
                                    }"
                                    class="btn btn-primary btn-sm"
                                >
                                    Criar
                                </router-link>                                  
                            </th>
                        </tr>
                    </thead>                
                    <tbody>
                        <tr v-for="(tipoCobranca, key) in tiposCobrancas" :key="key">
                            <td>{{ tipoCobranca.id }}</td>
                            <td>{{ tipoCobranca.nom_tipo_cobranca }}</td>
                            <td>{{ tipoCobranca.ind_status }}</td>
                            <td>
                                <router-link 
                                    :to="{
                                        name: 'tipos-cobrancas-edit',
                                        params: { id: tipoCobranca.id }
                                    }" 
                                    class="btn btn-primary btn-sm"
                                >edit</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteTipoCobranca(tipoCobranca.id)">
                                    deletar
                                </button>
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
                tiposCobrancas: []
            }
        },
        created() {
            this.getTipoCobrancas();
        },
        methods: {
            getTipoCobrancas(){
                axios.get('api/v1/tipos-cobrancas')
                    .then((response) => {
                        const data = response.data;
                        if(data.success == true){
                            this.tiposCobrancas = data.data;
                        }
                    })
                    .finally(() => {

                    });
            },
            deleteTipoCobranca(id){
                axios.delete(`api/v1/tipos-cobrancas/${id}`)
                    .then((response) => {
                        const data = response.data;
                        if(data.success == true){
                            this.getTipoCobrancas();
                        }
                    })
                    .finally(() => {

                    });
            }
        }
    }
</script>

