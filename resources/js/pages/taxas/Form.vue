<template>
    <div class="card">
        <div class="card-header">Taxa</div>
        <div class="card-body">
            <form @submit.prevent="onSubmit">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dsc_cotacao_taxa">Descrição Taxa Cobranca</label>
                            <textarea class="form-control" v-model="form.dsc_cotacao_taxa" id="dsc_cotacao_taxa"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo_cobranca_id">Tipo Cobranca</label>
                            <select name="tipo_cobranca_id" id="tipo_cobranca_id" class="form-control" v-model="form.tipo_cobranca_id">
                                <option 
                                    v-for="(tipoCobranca, key) in tiposCobrancas"
                                    :key="key"
                                    :value="tipoCobranca.id"
                                >{{ tipoCobranca.nom_tipo_cobranca }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="per_cotacao_taxa">Porcentagem Taxa Cobranca</label>
                            <input type="text" class="form-control" v-model="form.per_cotacao_taxa" id="per_cotacao_taxa" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="ind_status">Status</label>
                            <select name="ind_status" id="ind_status" class="form-control" v-model="form.ind_status">
                                <option 
                                    v-for="(status, key) in ind_status"
                                    :key="key"
                                    :value="status.val_dominio_item"
                                >{{ status.dsc_dominio_item }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ id == null ? 'Criar' : 'Salvar' }}
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
        },
        data() {
            return {
                id: null,
                ind_status: [],
                tiposCobrancas: [],
                form: {
                    dsc_cotacao_taxa: '',
                    tipo_cobranca_id: '',
                    per_cotacao_taxa: '',
                    ind_status: 1
                }
            }
        },
        created() {
            this.id = this.$route.params.id ?? null;
            try {
                Promise.all([
                    this.getDominioItens('ind_status'),
                    this.getTiposCobrancas(),
                    this.id != null
                        ? this.getCotacaoTaxa(this.id)
                        : null
                ]).then((responses) => {
                    console.log(responses);
                    this.ind_status = responses[0].data.data;
                    this.tiposCobrancas = responses[1].data.data;

                    if(responses[2] != null){
                        const formData = responses[2].data.data;

                        this.form.dsc_cotacao_taxa = formData.dsc_cotacao_taxa;
                        this.form.tipo_cobranca_id = formData.tipo_cobranca_id;
                        this.form.per_cotacao_taxa = formData.per_cotacao_taxa;
                        this.form.ind_status = formData.ind_status;
                    }
                    
                })
                
            } catch(e) {
                console.error(e);
            }
            
        },
        methods: {
            onSubmit(){
                this.id == null 
                    ? this.store()
                    : this.update(this.id);
            },            
            store(){
                axios.post(
                    "api/v1/cotacoes-taxas", 
                    this.form
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/cotacoes-taxas')
                        }
                    });
            },
            update(id){
                axios.put(
                    `api/v1/cotacoes-taxas/${id}`, 
                    this.form
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/cotacoes-taxas')
                        }
                    });
            },
            async getTiposCobrancas(){
                return await axios.get(
                    `api/v1/tipos-cobrancas`
                );
            },            
            async getCotacaoTaxa(id){
                return await axios.get(
                    `api/v1/cotacoes-taxas/${id}`
                );
            },
            async getDominioItens(dominioId){
                return await axios.get(`api/v1/dominios-itens/${dominioId}`);
            },            
        }
    }
</script>

