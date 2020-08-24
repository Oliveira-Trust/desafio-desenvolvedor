<template>
    <div class="Produtos">
        <b-form>
            <input id="product-id" type="hidden" v-model="product.id" />
            <b-form-group label="Nome:" label-for="product-name">
                <b-form-input id="product-name" type="text"
                    v-model="product.name" required
                    :readonly="mode === 'remove'"
                    placeholder="Informe o Nome do Produto..." />
            </b-form-group>
            <b-form-group label="preço" label-for="product-cost">
                <b-form-input id="product-cost" type="number"  min='0' 
                    v-model="product.cost" required
                    :readonly="mode === 'remove'"
                    placeholder="Informe o valor do Produto..." />
            </b-form-group>

            <b-button variant="primary" v-if="mode === 'save'"
                @click="save">Salvar</b-button>
            <b-button variant="danger" v-if="mode === 'remove'"
                @click="remove">Excluir</b-button>
            <b-button class="ml-2" @click="reset">Cancelar</b-button>
        </b-form>
        <hr>
        <b-table hover striped :items="produtos" :fields="fields">
            <template slot="actions" slot-scope="data">
                <b-button variant="warning" @click="loadProduct(data.item)" class="mr-2">
                    <i class="fa fa-pencil"></i>
                </b-button>
                <b-button variant="danger" @click="loadProduct(data.item, 'remove')">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
        </b-table>
     
    </div>
</template>

<script>
import { VueEditor, showError} from "vue2-editor"
import { baseApiUrl} from '@/global'
import axios from 'axios'

export default {
    name: 'Product',
    components: { VueEditor},
    data: function() {
        return {
            mode: 'save',
            product: {},
            produtos: [],
            fields: [
                { key: 'id', label: 'Código', sortable: true },
                { key: 'cost', label: 'preço', sortable: true },
                 { key: 'name', label: 'Nome', sortable: true },
                { key: 'quantity', label: 'Descrição', sortable: true },
                { key: 'actions', label: 'Ações' }
            ]
        }
    },
    methods: {
        loadProducts() {
            const url = `${baseApiUrl}/api/product`
                axios.get(url).then(res => {
                this.produtos = res.data.products                
            })
            
        },
        
        reset() {
            this.mode = 'save'
            this.product = {}
            this.loadProducts()
        },
        save() {
            const method = this.product.id ? 'put' : 'post'
            const id = this.product.id ? `/${this.product.id}` : ''
            axios[method](`${baseApiUrl}/api/product${id}`, this.product)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        remove() {
            const id = this.product.id
            axios.delete(`${baseApiUrl}/api/product/${id}`)
                .then(() => {
                    this.$toasted.global.defaultSuccess()
                    this.reset()
                })
                .catch(showError)
        },
        loadProduct(product, mode = 'save') {
            this.mode = mode
            this.product = { ...product }
                                
        },

    },
    mounted() {
        this.loadProducts()
    }
}
</script>

<style>

</style>