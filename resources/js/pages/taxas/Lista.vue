<template>
    <div>
    <div class="card">
        <div class="card-header">Taxa</div>
            <div class="card-body">
 
                <table class="table table-condensed table-bordered table-dark table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo de Cobrança</th>
                            <th>Descrição</th>
                            <th>Porcentagem (%)</th>
                            <th>Range</th>
                            <th>Status</th>
                            <th>
                                <router-link 
                                    :to="{
                                        name: 'cotacoes-taxas-create'
                                    }"
                                    class="btn btn-primary btn-sm"
                                >
                                    Criar
                                </router-link> 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(cotacaoTaxa, key) in cotacoes_taxas" :key="key">
                            <td>{{ cotacaoTaxa.id }}</td>
                            <td>{{ cotacaoTaxa.tipo_cobranca.nom_tipo_cobranca }}</td>
                            <td>{{ cotacaoTaxa.dsc_cotacao_taxa }}</td>
                            <td>{{ cotacaoTaxa.per_cotacao_taxa }}%</td>
                            <td>
                                <span v-if="cotacaoTaxa.cotacao_taxa_range != null">
                                    <span class="badge badge-primary w-70" v-if="cotacaoTaxa.cotacao_taxa_range.val_minimo != null && cotacaoTaxa.cotacao_taxa_range.val_maximo != null">
                                        {{ cotacaoTaxa.cotacao_taxa_range.val_minimo }} ~ {{ cotacaoTaxa.cotacao_taxa_range.val_maximo }}
                                    </span>
                                    <span class="badge badge-primary w-70" v-if="cotacaoTaxa.cotacao_taxa_range.val_minimo == null && cotacaoTaxa.cotacao_taxa_range.val_maximo != null">
                                        &gt;= {{ cotacaoTaxa.cotacao_taxa_range.val_maximo }}
                                    </span>
                                    <span class="badge badge-primary w-70" v-if="cotacaoTaxa.cotacao_taxa_range.val_maximo == null && cotacaoTaxa.cotacao_taxa_range.val_minimo != null">
                                        &lt;= {{ cotacaoTaxa.cotacao_taxa_range.val_minimo }}
                                    </span>
                                    <span
                                        class="badge badge-danger w-30"
                                        :style="{ cursor: 'pointer' }"
                                        @click="deleteCotacaoTaxaRange(cotacaoTaxa.cotacao_taxa_range.cotacao_taxa_id)"
                                     >X</span>
                                </span>
                                <span class="badge badge-danger col-12"  v-if="cotacaoTaxa.cotacao_taxa_range == null">Sem Range</span>
                            </td>
                            <td>
                                {{ cotacaoTaxa.ind_status }}
                            </td>
                            <td>
                                <router-link 
                                    :to="{
                                        name: 'cotacoes-taxas-ranges-edit',
                                        params: { id: cotacaoTaxa.id }
                                    }" 
                                    class="btn btn-success btn-sm"
                                >
                                    {{  
                                        cotacaoTaxa.cotacao_taxa_range == null
                                        ? `adicionar range`
                                        :  `editar range`
                                    }}
                                </router-link>
                                <router-link 
                                    :to="{
                                        name: 'cotacoes-taxas-edit',
                                        params: { id: cotacaoTaxa.id }
                                    }" 
                                    class="btn btn-primary btn-sm"
                                >edit</router-link>

                                <button class="btn btn-danger btn-sm" @click="deleteCotacaoTaxa(cotacaoTaxa.id)">
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
        name: 'lista-taxa',
        data() {
            return {
                cotacoes_taxas: [],
                ind_status: []
            }
        },
        created() {
            this.getTaxas();
            this.getDominioItens();
        },
        methods: {
            getTaxas(){
                axios.get('api/v1/cotacoes-taxas')
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.cotacoes_taxas = data.data;
                        }
                    })
                    .finally(() => {

                    });
            },
            getDominioItens(){
                axios.get('api/v1/dominios-itens/ind_status')
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.ind_status = data.data.ind_status;
                        }
                    })
                    .finally(() => {

                    });
            },
            deleteCotacaoTaxaRange(id){
                axios.delete(`api/v1/cotacoes-taxas-ranges/${id}`)
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.getTaxas();
                        }
                    })
                    .finally(() => {

                    });
            },
            deleteCotacaoTaxa(id){
                axios.delete(`api/v1/cotacoes-taxas/${id}`)
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.getTaxas();
                        }
                    })
                    .finally(() => {

                    });
            }
        }
    }
</script>

