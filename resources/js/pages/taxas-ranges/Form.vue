<template>
    <div>
        <div class="card">
            <div class="card-header">
                Taxa
            </div>
            <div class="card-body">
                <form @submit.prevent="onSubmit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="val_minimo">Valor Mínimo</label>
                                <input type="text" class="form-control" v-model="form.val_minimo" id="val_minimo"  >
                            </div>
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="val_maximo">Valor Máximo</label>
                                <input type="text" class="form-control" v-model="form.val_maximo" id="val_maximo" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ind_status">Status</label>
                                <select name="ind_status" id="ind_status" class="form-control" v-model="form.ind_status">
                                    <option 
                                        v-for="(status, key) in indStatus"
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

                <pre class="alert alert-danger mt-2" v-if="Object.keys(errors).length > 0">{{ errors }}</pre>
            </div>
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
                indStatus: [],
                form: {
                    cotacao_taxa_id: null,
                    val_minimo: '',
                    val_maximo: '',
                    ind_status: 1
                },
                errors: {}
            }
        },
        created() {
            this.id = this.$route.params.id ?? null;
            if(this.id != null){
                this.getCotacaoTaxaRange(this.id);
            }
            this.getDominioItens('ind_status');
        },
        methods: {
            onSubmit(){
                this.id == null 
                    ? this.store()
                    : this.update(this.id);
            },
            getCotacaoTaxaRange(id){
                axios.get(
                    `api/v1/cotacoes-taxas-ranges/${id}`
                )
                    .then((response) => {
                        console.log('r', response);
                        const data = response.data;
                        if(data.success && data.data != null){
                            this.form.val_minimo = data.data.val_minimo;
                            this.form.val_maximo = data.data.val_maximo;
                            this.form.ind_status = data.data.ind_status;
                        }
                    });
            },
            getDominioItens(dominioId){
                axios.get(`api/v1/dominios-itens/${dominioId}`)
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.indStatus = data.data;
                        }
                    })
                    .finally(() => {

                    });
            },              
            store(){
                this.errors = {};
                axios.post(
                    "api/v1/cotacoes-taxas-ranges", 
                    this.form
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/cotacoes-taxas');
                        }
                    })
                    .catch(errors => {
                        this.errors = errors.response.data;
                    });
            },
            update(id){
                this.errors = {};
                axios.put(
                    `api/v1/cotacoes-taxas-ranges/${id}`, 
                    this.form
                )
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/cotacoes-taxas');
                        }
                    })
                    .catch(errors => {
                        this.errors = errors.response.data;
                    });
            } 
        }
    }
</script>

