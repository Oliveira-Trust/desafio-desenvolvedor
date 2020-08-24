<template>
    <div class="pedidos-admin">
        <b-form>
            <input id="pedidos-id" type="hidden" v-model="transaction.id" />
            <b-form-group label="Nome:" label-for="pedidos-name">
                <b-form-input id="pedidos-name" type="text"
                    v-model="transaction.name" required
                    :readonly="mode === 'remove'"
                    placeholder="Informe o Nome da Produto..." />
            </b-form-group>
            <b-form-group label="status:" label-for="pedidos-name">
                <b-form-input id="pedidos-name" type="number" min='1' max='3'
                    v-model="transaction.name" required
                    :readonly="mode === 'remove'"
                    placeholder="Informe o Nome do Produto..." />
            </b-form-group>
            
            <b-button variant="primary" v-if="mode === 'save'"
                @click="save">Salvar</b-button>
            <b-button variant="danger" v-if="mode === 'remove'"
                @click="remove">Excluir</b-button>
            <b-button class="ml-2" @click="reset">Cancelar</b-button>
        </b-form>
        <hr>
        <b-table hover striped :items="pedidos" :fields="fields">
            <template slot="actions" slot-scope="data">
                <b-button variant="warning" @click="loadTransaction(data.item)" class="mr-2">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button variant="danger" @click="loadTransaction(data.item, 'remove')">
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
    name: 'CategoryAdmin',
    data: function() {
        return {
            mode: 'save',
            transaction: {},
            pedidos: [],
            fields: [
                { key: 'id', label: 'Código', sortable: true },
                { key: 'status', label: 'status', sortable: true },
                { key: 'actions', label: 'Ações' }
            ]
        }
    },
    methods: {
        loadTransaction() {
            const url = `${baseApiUrl}/api/transaction`
            axios.get(url).then(res => {
                this.pedidos = res.data.trasancitons
            
            })
        },
        reset() {
            this.mode = 'save'
            this.transaction = {}
            this.loadTransactions()
        },
        save() {
            const method = this.transaction.id ? 'put' : 'post'
            const id = this.transaction.id ? `/${this.transaction.id}` : ''
            axios[method](`${baseApiUrl}/transaction${id}`, this.transaction)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        remove() {
            const id = this.transaction.id
            axios.delete(`${baseApiUrl}/transaction/${id}`)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        loadTransactions(transaction, mode = 'save') {
            this.mode = mode
            this.transaction = { ...transaction }
        }
    },
    mounted() {
        this.loadTransaction()
    }
}
</script>

<style>

</style>