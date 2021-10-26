<template>
    <div>
        <div class="card">
            <div class="card-header">
                Tipo de Cobrança
            </div>
            <div class="card-body">
                <form @submit.prevent="onSubmit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="val_maximo">Tipo de Cobrança</label>
                                <input type="text" class="form-control" v-model="form.nom_tipo_cobranca" id="val_maximo" >
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
        data() {
            return {
                id: null,
                indStatus: [],
                form: {
                    nom_tipo_cobranca: '',
                    ind_status: 1
                },
                errors: {}
            }
        },
        created() {
            this.id = this.$route.params.id ?? null;
            if(this.id != null){
                this.getTipoCobranca(this.id);
            }
            this.getDominioItens('ind_status');
        },
        methods: {
            onSubmit(){
                this.id == null 
                    ? this.store()
                    : this.update(this.id);
            },
            getTipoCobranca(id){
                axios.get(
                    `api/v1/tipos-cobrancas/${id}`, 
                    this.form
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.form.nom_tipo_cobranca = data.data.nom_tipo_cobranca;
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
                    "api/v1/tipos-cobrancas", 
                    this.form
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/tipos-cobrancas')
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                        this.errors = errors.response.data;
                    });
            },
            update(id){
                this.errors = {};
                axios.put(
                    `api/v1/tipos-cobrancas/${id}`, 
                    this.form
                )
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success){
                            this.$router.push('/tipos-cobrancas');   
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                        this.errors = errors.response.data;
                    });
            } 
        }
    }
</script>

