<template>
    <div>
        <div class="card">
            <div class="card-header">
                Calcular.
            </div>
            <div class="card-body">
                <h2 v-if="loading">Carregando...</h2>
                <fieldset :disabled="loading" :style="{ opacity: loading ? '0.8': 1 }">
                    <form @submit.prevent="onSubmit">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="val_quantia">Valor</label>
                                    <input type="text" v-model="form.val_quantia" id="val_quantia" class="form-control" value="5000">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="moeda_origem_id">Moeda Origem</label>
                                    <select v-model="form.moeda_origem_id" id="moeda_origem_id" class="form-control ignoreSelect2">
                                        <option 
                                            v-for="(moeda, key) in moedas"
                                            :key="key"
                                            :value="key"
                                        >{{ moeda }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="moeda_destino_id">Moeda Destino</label>
                                    <select v-model="form.moeda_destino_id" id="moeda_destino_id" class="form-control ignoreSelect2">
                                        <option 
                                            v-for="(moeda, key) in moedas"
                                            :key="key"
                                            :value="key"
                                        >{{ moeda }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo_cobranca_id">Forma de pagamento</label>
                                    <select v-model="form.tipo_cobranca_id" id="tipo_cobranca_id" class="form-control ignoreSelect2">
                                        <option 
                                            v-for="(tipoCobranca, key) in tiposCobrancas"
                                            :key="key"
                                            :value="tipoCobranca.id"
                                        >{{ tipoCobranca.nom_tipo_cobranca }}</option>
                                    </select>
                                </div>
                            </div>            
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </fieldset>
            </div>
        </div>
        <section class="mt-3">
            <pre class="alert alert-success on-success" v-if="Object.keys(onSuccess).length > 0">{{ onSuccess }}</pre>
            <pre class="alert alert-danger on-error" v-if="Object.keys(onError).length > 0">{{ onError }}</pre>
        </section>
    </div>
</template>

<script>
    export default {
        name: 'cotacao-cotacao-form',
        data() {
            return {
                loading: false,
                form: {
                    val_quantia: 5000,
                    tipo_cobranca_id: 1,
                    moeda_origem_id: 'BRL',
                    moeda_destino_id: 'USD',
                },
                moedas: [],
                tiposCobrancas: [],
                onSuccess: {},
                onError: {},
            }
        },
        created() {
            this.getMoedas();
            this.getTiposCobrancas();
        },
        methods: {
            onSubmit(){
                this.onSuccess = {};
                this.onError = {};
                this.loading = true;
                axios.post('api/v1/user-cotacoes/calcular', 
                    this.form
                )
                    .then((response) => {
                        console.log('response', response);
                        const data = response.data;
                        if(data.success == true){
                            this.onSuccess = JSON.stringify(data.data, undefined, 2);
                            return;
                        }

                        this.onError = JSON.stringify(data.data, undefined, 2);
                    })
                    .catch(error => {
                        this.onError = error.response.data;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            },
            getMoedas(){
                 axios.get('api/v1/moedas')
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.moedas = data.data;
                        }
                    })
                    .finally(() => {

                    });
            },
            getTiposCobrancas(){
                return axios.get(
                    `api/v1/tipos-cobrancas`
                )
                    .then((response) => {
                        const data = response.data;
                        if(data.success){
                            this.tiposCobrancas = data.data;
                        }
                    })
            },
        }
    }
</script>

