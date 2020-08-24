<template>
    <div class="user-admin">
        <b-form>
            <b-row>
                <input id="client-id" type="hidden" v-model="client.id" />
                <b-col md="6" sm="12">
                    <b-form-group label="Nome:" label-for="client-name">
                        <b-form-input id="client-name" type="text"
                            v-model="client.name" required
                            :readonly="mode === 'remove'"
                            placeholder="Informe o Nome do Usuário..." />
                    </b-form-group>
                </b-col>
                <b-col md="6" sm="12">
                    <b-form-group label="E-mail:" label-for="client-email">
                        <b-form-input id="client-email" type="text"
                            v-model="client.email" required
                            :readonly="mode === 'remove'"
                            placeholder="Informe o E-mail do Usuário..." />
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
            <b-col md="6" sm="12">
                    <b-form-group label="Endereço" label-for="client-address">
                        <b-form-input id="client-address" type="text"
                            v-model="client.address" required
                            :readonly="mode === 'remove'"
                            placeholder="Informe o endereço" />
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col xs="12">
                    <b-button variant="primary" v-if="mode === 'save'"
                        @click="save">Salvar</b-button>
                    <b-button variant="danger" v-if="mode === 'remove'"
                        @click="remove">Excluir</b-button>
                    <b-button class="ml-2" @click="reset">Cancelar</b-button>
                </b-col>
            </b-row>
        </b-form>
        <hr>
        <b-table hover striped :items="clientes" :fields="fields">
            <template slot="actions" slot-scope="data">
                <b-button variant="warning" @click="loadClient(data.item)" class="mr-2">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button variant="danger" @click="loadClient(data.item, 'remove')">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
import { baseApiUrl, showError } from '@/global'
import axios from 'axios'

export default {
    name: 'Client',
    data: function() {
        return {
            mode: 'save',
            client:{},
            clientes: [],
            fields: [
                { key: 'id', label: 'Código', sortable: true },
                { key: 'name', label: 'Nome', sortable: true },
                { key: 'email', label: 'E-mail', sortable: true },
                { key: 'address', label: 'endereço', sortable: true,},
                { key: 'actions', label: 'Ações' }
            ]
        }
    },
    methods: {
        loadClients() {
            const url = `${baseApiUrl}/api/client`
                axios.get(url).then(res => {
                this.clientes = res.data.client                
            })
            
        },
        
        reset() {
            this.mode = 'save'
            this.client = {}
            this.loadClients()
        },
        save() {
            const method = this.client.id ? 'put' : 'post'
            const id = this.client.id ? `/${this.client.id}` : ''
            axios[method](`${baseApiUrl}/api/client${id}`, this.client)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        remove() {
            const id = this.client.id
            axios.delete(`${baseApiUrl}/api/client/${id}`)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        loadClient(client, mode = 'save') {
            this.mode = mode
            this.client = { ...client }
        },
    },
    mounted() {
        this.loadClients()
    }
}
</script>

<style>

</style>