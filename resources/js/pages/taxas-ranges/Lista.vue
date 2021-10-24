<template>
    <div>
    <div class="card">
        <div class="card-header">Taxa Range</div>
            <div class="card-body">
                <table class="table table-dark table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Valor Minimo</th>
                            <th>Valor Máximo</th>
                            <th>
                                <router-link 
                                    :to="{
                                        name: 'cotacoes-taxas-ranges-create'
                                    }"
                                    class="btn btn-primary btn-sm"
                                >
                                    Criar
                                </router-link> 
                            </th>
                        </tr>
                    </thead>                
                    <tbody>
                        <tr v-for="(cotacaoTaxaRange, key) in cotacoesTaxasRanges" :key="key">
                            <td>{{ cotacaoTaxaRange.cotacao_taxa_id }}</td>
                            <td>{{ cotacaoTaxaRange.val_minimo }}</td>
                            <td>{{ cotacaoTaxaRange.val_maximo }}</td>
                            <td>
                                <router-link 
                                    :to="{
                                        name: 'cotacoes-taxas-ranges-edit',
                                        params: { id: cotacaoTaxaRange.cotacao_taxa_id }
                                    }" 
                                    class="btn btn-primary btn-sm"
                                >edit</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteCotacaoTaxaRange(cotacaoTaxaRange.cotacao_taxa_id)">
                                    deletar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <pre>{{ cotacoesTaxasRanges }}</pre>
    </div>
</template>

<script>
    export default {
        name: 'lista-taxa',
        data() {
            return {
                cotacoesTaxasRanges: []
            }
        },
        created() {
            this.getTaxasRanges();
        },
        methods: {
            getTaxasRanges(){
                axios.get('api/v1/cotacoes-taxas-ranges')
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.cotacoesTaxasRanges = data.data;
                        }
                    })
                    .finally(() => {

                    });
            },
            deleteCotacaoTaxaRange(id){
                axios.delete(`api/v1/cotacoes-taxas-ranges/${id}`)
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.getTaxasRanges();
                        }
                    })
                    .finally(() => {

                    });
            }
        }
    }
</script>

